<?php


namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ShippedOrdersExport implements FromCollection, WithHeadings
{
    protected $selectedOrderIds;

    public function __construct(array $selectedOrderIds)
    {
        $this->selectedOrderIds = $selectedOrderIds;
    }

    public function collection()
    {
        $orders = Order::whereIn('id', $this->selectedOrderIds)->with('invoice')->get();
        $data = [];
        if($orders){
            foreach ($orders as $order) {
                $data[] = [
                    $order->id,
                    $order->shipping_address,
                    $order->invoice->id,
                    $order->invoice->created_at,
                    Cache::get('tracking_id_' . $order->invoice->id)
                ];
            };
        }

        return new Collection($data);
        
    }

    public function headings(): array
    {
        return [
            'Order Id',
            'Address',
            'Invoice Number',
            'Invoice Date',
            'Tracking No',
            
        ];
    }
}