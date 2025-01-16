<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\mailController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LoginAccessPage;
use App\Http\Middleware\CustomAuthMiddleware;
use App\Http\Controllers\DomPdfController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\PayPalController;






Route::redirect('/', 'admin/login');

Route::middleware(['pageaccesslogin'])->group(function () {
    Route::get('/admin/login', [AdminController::class, 'login_index'])->name('admin.login.index');
    Route::post('/admin/login', [AdminController::class, 'loginAdmin'])->name('admin.login');
});


Route::get('/admin/logout', [AdminController::class, 'logoutAdmin'])->name('admin.logout');

Route::get('forget_password', [AdminController::class, 'forget_password_index_page'])->name('forget.passwordd');
Route::post('forget_password', [AdminController::class, 'forget_password'])->name('forget.password');
Route::get('/send_mail', [mailController::class, 'index'])->name('mail.send');
Route::get('/reset_password/{token}', [AdminController::class, 'showResetForm'])->name('showResetForm');
Route::post('/reset_password', [AdminController::class, 'resetPassword'])->name('resetPassword');

Route::middleware(['custom.auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard_index'])->name('admin.dashboard.index');
    Route::get('/admin/manage-lead', [AdminController::class, 'manage_lead_index'])->name('admin.manage-lead.index');
    Route::get('/admin/manage-batch', [AdminController::class, 'manageBatches'])->name('admin.manage.batch');
    Route::get('/add-batches-form', [AdminController::class, 'addBatchForm'])->name('add.batch.form');
    Route::post('/add-batches', [AdminController::class, 'addBatch'])->name('add.batch');


    Route::get('/admin/manage-latest-orders', [AdminController::class, 'manageLatestOrders'])->name('admin.manage.latest.orders');
    Route::get('show/latest/orders/{data}', [AdminController::class, 'showLatestOrder'])->name('show-latest-order');
    Route::get('/admin/manage-shipped-orders', [AdminController::class, 'manageShippedOrders'])->name('admin.manage.shipped.orders');
    Route::get('/shipped/order/view/{id}', [AdminController::class, 'shippedOrderView'])->name('manage-shipped-view');
    Route::get('/admin/leads-view/{lead}', [AdminController::class, 'showLead'])->name('leads.show');
    Route::get('/manage-batches', [AdminController::class, 'index'])->name('batches.index');
    Route::get('/orders/export', [AdminController::class, 'bulkExportOrders'])->name('orders.export');
    Route::post('/orders/export-selected', [AdminController::class, 'exportSelectedOrders'])->name('orders.exportSelected');
    Route::post('/orders/import', [AdminController::class, 'importOrders'])->name('orders.import');
    Route::post('/invoice-pdf', [DomPdfController::class, 'getInvoice'])->name('orders.invoices');
    // Route::post('/prescription-pdf', [DomPdfController::class, 'getPrescription'])->name('orders.prescription');
    // Route::get('/prescription-pdf', [DomPdfController::class, 'getPrescription'])->name('orders.prescription');

    Route::match(['get', 'post'], '/viewPrescriptions', [DomPdfController::class, 'selectedPrescriptions'])->name('bulk.export.prescription');
    // Route::get('/viewPrescriptions', [DomPdfController::class,'selectedPrescriptions'])->name('bulk.export.prescription');

    Route::post('/export/shipping/from', [DomPdfController::class, 'exportShippingFrom'])->name('export.shipping.lable.from');
    Route::post('/export/shipping/to', [DomPdfController::class, 'exportShippingTo'])->name('export.shipping.lable.to');
    Route::get('/notification', [AdminController::class, 'notification'])->name('notification');
    Route::match(['get', 'post'], '/invoice-pdf-shipped', [DomPdfController::class, 'getInvoiceShipped'])->name('orders.invoices.shipped');
    Route::post('/export/shipped/orders', [AdminController::class, 'exportSelectedShipped'])->name('export.selected.shipped');
    
    
    
    Route::get('razorpay', [RazorpayController::class, 'razorpay'])->name('razorpay');
    Route::post('razorpaypayment', [RazorpayController::class, 'payment'])->name('payment');




    // paypal routes

    Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
    Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');



    Route::get('/sendPrescriptionLink', [DomPdfController::class, 'sendPrescriptionLink']);
    Route::get('/viewprescription/{token}', [DomPdfController::class,'viewprescription'])->name('prescription.show');
    Route::get('/viewInvoice/{id}', [DomPdfController::class,'viewInvoice'])->name('viewInvoice');

});
