<?php

namespace App\Exports;

use App\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExportMapping implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::with('products')->whereNotNull('username')->get();
    }

    public function map($order) : array {
        return [
            $order->status,
            $order->username,
            $order->email,
            $order->address,
            $order->phone,
            $order->products->get(0)->description,
            $order->products->first()->pivot->quantity,
            $order->totalQuantity,
            Carbon::parse($order->created_at)->toFormattedDateString(),
            $order->total_price 
        ];
    }

    public function headings() : array {
        return [
           'Status',
           'Buyer Name',
           'email',
           'Address',
           'Phone',
           'Product',
           'Total Quantity',
           'Order Date',
           'Total Price'
        ] ;
    }
}
