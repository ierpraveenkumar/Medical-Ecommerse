<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\Preset;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Lead;
use App\Models\Batch;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrdersImport;
use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Support\Facades\Cache;
use App\Exports\SelectedOrdersExport;
use App\Exports\ShippedOrdersExport;
use Illuminate\Pagination\Paginator;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Notifications\NewLeadNotification;


class AdminController extends Controller
{
    public function login_index()
    {
        return view('Admin.login');
    }



    public function loginAdmin(Request $req)
    {

        // Check if the user is already authenticated
        if (Session::has('login_id')) {
            return redirect()->route('admin.dashboard.index');
        }

        $req->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/',
            ],
        ]);


        $admin = Admin::where('email', $req->email)->first();

        if ($admin) {
            if ($req->password === $admin->password) {
                // Password matches, log in the admin
                Session::put('login_id', $admin->id);
                return redirect()->route('admin.dashboard.index');
            } else {
                // Password does not match
                return redirect()->back()->with('fail', 'Password does not match');
            }
        } else {
            // Admin not found
            return redirect()->back()->with('fail', 'Email is not registered');
        }
    }

    public function logoutAdmin()
    {
        Session::flush();

        return redirect()->route('admin.login.index');
    }



    public function forget_password_index_page()
    {
        return view('forget_password');
    }

    public function forget_password(Request $request)
    {
        $user = Admin::where('email', $request->email)->first();

        if ($user) {
            $token = $this->generateToken();
            $resetPassword = new Preset();
            $resetPassword->email = $request->email;
            $resetPassword->token = $token;
            $resetPassword->save();

            $resetLink = url("/reset_password/{$token}");

            $mailData = [
                'title' => 'Recovery Password for your forget mail query',
                'body' => 'Your Password Reset link is ' . $resetLink,
            ];
            dd($mailData);
            Mail::to('p7484823093@gmail.com')->send(new DemoMail($mailData));

            return redirect()->back()->with('success', 'I have sent a password reset link ...so please check your email ');
            // dd('Email send success...');
        }
        return redirect()->back()->with('fail', 'This mail is not a valid email ...please try again');

    }

    public function showResetForm($token)
    {
        $tokenData = Preset::where('token', $token)->first();
        if ($tokenData) {
            return view('reset_password', ['token' => $token]);
        }

        return "Invalid request";

    }
    /**
     *     Add logic to update the user's password
     *     Delete the token data after successful password reset
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);
        $tokenData = Preset::where('token', $request->token)->first();
        if (!$tokenData) {
            return redirect()->route('forget.password')->with('error', 'Token Expired ');
        }
        $user = Admin::where('email', $tokenData->email)->first();
        $user->password = $request->password;
        $user->save();
        $tokenData->delete();
        return redirect()->route('admin.login.index')->with('success', 'Please Try Now... Your Password Has been Reset Successfully.');
    }



    /**
     *   helper functions
     */

    private function generateToken()
    {
        return bin2hex(random_bytes(32));
    }





    public function dashboard_index()
    {
        $todaysOrdersCount = Order::whereDate('created_at', now()->toDateString())->count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $openLeadsCount = Lead::where('converted_to_order', '0')->count();
        $completedOrdersCount = Order::where('status', 'delivered')->count();

        return view(
            'Admin.Pages.dashboard',
            compact(
                'todaysOrdersCount',
                'pendingOrdersCount',
                'openLeadsCount',
                'completedOrdersCount'
            )
        );


    }



    public function manage_lead_index()
    {
        $leads = Lead::paginate(2);
        Paginator::useBootstrap();

        return view('Admin.Pages.manage-lead', compact('leads'));
    }

    


    public function showLead($lead)
    {
        // Assuming you have a method to fetch the Lead model by ID
        $lead = Lead::find($lead);

        return view('Admin.Pages.lead-view', compact('lead'));
    }

    public function manageBatches()
    {
        $batches = Batch::with('products')->paginate(3);
        Paginator::useBootstrap();
        return view('Admin.Pages.manage-batch', compact('batches'));
    }


    public function addBatchForm()
    {
        return view('Admin.Pages.add_batch');
    }

    public function addBatch(Request $req)
    {
        $admin = Admin::all();

        $productNames = $req->product_name;
        $productTypes = $req->product_type;
        $batchNos = $req->batch_no;
        $mfgDates = $req->mfg_date;
        $expiryDates = $req->expiry_date;
        $quantities = $req->quantity; // Adding quantities array

        foreach ($productNames as $key => $productName) {
            // Create a new batch with default quantity of 1
            $batch = new Batch();
            $batch->product_type = $productTypes[$key];
            $batch->batch_no = $batchNos[$key];
            $batch->mfg_date = date('Y-m-d', strtotime($mfgDates[$key]));
            $batch->expiry_date = date('Y-m-d', strtotime($expiryDates[$key]));
            $batch->quantity = 1; // Default quantity to 1
            $batch->save();

            // Retrieve the ID of the newly created batch
            $batchId = $batch->id;

            // Create a related product with the specified quantity
            $product = new Product();
            $product->name = $productName;
            $product->quantity = $quantities[$key]; // Assign quantity from form input
            $product->batch_id = $batchId;
            $product->save();


            $productData = [
                'product_name' => $req->product_name,
                'batch_no' => $req->batch_no,
            ];

            Notification::send($admin, new OrderNotification($productData));
        }

        return redirect()->route('admin.manage.batch')->with('success', 'Data Saved Successfully');
    }




    public function manageLatestOrders()
    {
        $leads = Lead::with('order.invoice')->where('converted_to_order', 1)->get();
        // dd($leads->toArray());
        return view('Admin.Pages.manage-latest-orders', compact('leads'));
    }

    public function showLatestOrder($data)
    {
        $data = Order::find($data);
        return view('Admin.Pages.show-latest-order', compact('data'));

    }



    /**
     * this function was used before i used checkbok
     * now it is modified n here it is below this 
     *
     *public function manageShippedOrders(){
     *    $orders=Order::with('invoice')->get();
     *     return view('Admin.Pages.manage-shipped-orders',compact('orders'));
     *}
     */
    public function manageShippedOrders(Request $request)
    {
        $query = Order::with('invoice');

        // Filter by date range if provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereHas('invoice', function ($query) use ($request) {
                $query->whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')]);
            });
        }

        $orders = $query->get();
        // dd($orders);
        return view('Admin.Pages.manage-shipped-orders', compact('orders'));
    }
    public function shippedOrderView($id)
    {
        $data = Order::find($id);
        return view('Admin.Pages.shippedOrderView', compact('data'));
    }

    public function generateTrackingId($invoiceId)
    {
        // Check if a tracking ID is already generated for this invoice
        $cachedTrackingId = Cache::get('tracking_id_' . $invoiceId);

        if ($cachedTrackingId) {
            return $cachedTrackingId;
        }

        // Prefix "ED" for the tracking ID
        $prefix = 'ED';

        // Convert the invoice ID to a string
        $invoiceIdString = strval($invoiceId);

        // Pad the invoice ID with leading zeros to achieve a total length of 6 characters
        $paddedInvoiceId = str_pad($invoiceIdString, 6, '0', STR_PAD_LEFT);

        // Generate a random 3-digit number
        $randomDigits = rand(100, 999);

        // Suffix "I" for the tracking ID
        $suffix = 'I';

        // Concatenate the parts to form the tracking ID
        $trackingId = $prefix . $paddedInvoiceId . $randomDigits . $suffix;

        // Store the tracking ID in the cache for this invoice
        Cache::put('tracking_id_' . $invoiceId, $trackingId, 60 * 24); // Cache for 24 hours

        return $trackingId;
    }




    public function exportSelectedOrders(Request $request)
    {
        //return response()->json(['data'=>$request->all()]);
        $selectedOrderIds = $request->input('selectedOrders');

        if ($selectedOrderIds != null) {
            return Excel::download(new SelectedOrdersExport($selectedOrderIds), 'selected_orders.csv');
            //return response()->json(['csvData'=>$csvData]);
        }
        return redirect()->back()->with('fail', 'please select atleast a row');
    }
    /**
     * this function is not in use 
     * i used it as bulk export the orders using button bulk export prescription
     * but this is not the requirement
     * but needed the code for future requirement


        public function bulkExportOrders()
    {
        return Excel::download(new OrdersExport, 'OrdersBulk.csv');
    }
         */




    public function importOrders(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);


        $rows = Excel::toArray([], request()->file('csv_file'))[0];
        // dd($rows);
        for ($i = 1; $i < count($rows); $i++) {
            $order = new Order();
            $order->id = $rows[$i][0];
            $order->lead_id = $rows[$i][1];
            $order->shipping_address = $rows[$i][2];
            $order->billing_address = $rows[$i][3];
            $order->status = $rows[$i][4];
            $order->save();
        }
        return response()->json(['message' => 'Data Uploaded Successfully']);
    }



    public function exportSelectedShipped(Request $request)
    {

        $selectedOrderIds = $request->input('selectedOrders');

        if ($selectedOrderIds != null) {
            return Excel::download(new ShippedOrdersExport($selectedOrderIds), 'shipped_orders.csv');
        }
        return redirect()->back()->with('fail', 'please select atleast a row');
    }





    public function notification()
    {

        $admin = Admin::find(2);
        return view('Admin.Pages.notification', compact('admin'));
    }




}


