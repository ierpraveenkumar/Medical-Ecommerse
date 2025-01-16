<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{


    /***
     * this is not in use 
     * but for future use i want to save it here
     * 
    */
    public function collection()
    {
        $leads = Lead::with('order.invoice')->get();

        $orders = collect([]);

        foreach ($leads as $lead) {
            if ($lead->order) {
                $orders->push([
                    'Order Id' => $lead->order->id ?? '',
                    'Name' => $lead->first_name . ' ' . $lead->last_name,
                    'Address' => $lead->order->shipping_address ?? '',
                    'Invoice Number' => $lead->order->invoice->id ?? '',
                    'Order Date' => $lead->order->created_at ?? '',
                ]);
            }
        }

        return $orders;
    }

    public function headings(): array
    {
        return [
            'Order Id',
            'Name',
            'Address',
            'Invoice Number',
            'Order Date',
        ];
    }
}