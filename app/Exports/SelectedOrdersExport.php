<?php


namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SelectedOrdersExport implements FromCollection, WithHeadings
{
    protected $selectedOrderIds;

    public function __construct(array $selectedOrderIds)
    {
        $this->selectedOrderIds = $selectedOrderIds;
    }

    public function collection()
    {
        return Order::whereIn('id', $this->selectedOrderIds)->get();
    }

    public function headings(): array
    {
        return [
            'Order Id',
            'Lead Id',
            'Shipping Address',
            'Billing Address',
            'Status',
            'Created At',
            'Updated At'
        ];
    }
}