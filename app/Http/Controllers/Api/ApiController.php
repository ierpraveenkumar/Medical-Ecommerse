<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Lead;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class ApiController extends Controller
{
    public function storeLead(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',

            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
            Lead::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);
            return response()->json(['message' => 'data saved successfully'], 201);
        } catch (\Exception $e) {
            // return $e;
            return response()->json(['message' => 'error creating data'], 500);
        }
    }

public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_type' => 'required',
            'batch_no' => 'required',
            'quantity' => 'required',
            'mfg_date' => 'required|date_format:d/m/Y', // Ensure date format is 'd/m/Y'
            'expiry_date' => 'required|date_format:d/m/Y', // Ensure date format is 'd/m/Y'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Convert date strings to the appropriate format
        $mfgDate = Carbon::createFromFormat('d/m/Y', $request->mfg_date)->toDateString();
        $expiryDate = Carbon::createFromFormat('d/m/Y', $request->expiry_date)->toDateString();

        $batch = Batch::create([
            'product_type' => $request->product_type,
            'batch_no' => $request->batch_no,
            'mfg_date' => $mfgDate, // Insert converted date
            'expiry_date' => $expiryDate, // Insert converted date
        ]);

        Product::create([
            'name' => $request->product_name,
            'quantity' => $request->quantity,
            'batch_id' => $batch->id,
        ]);

        return response()->json(['message' => 'Data saved successfully'], 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error creating data'], 500);
    }
}



}
