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
        $rows = [];
        foreach ($order->products as $p) {
            array_push($rows,[
                $order->status,
                $order->username,
                $order->email,
                $order->address,
                $order->phone,
                $p->description,
                $p->pivot->quantity,
                $p->price,
                $p->price * $p->pivot->quantity,
                Carbon::parse($order->created_at)->toFormattedDateString()
            ]);
        }
        return $rows;
    }

    public function headings() : array {
        return [
           'Status',
           'Buyer Name',
           'Email',
           'Address',
           'Phone',
           'Product',
           'Quantity',
           'Price',
           'Total Price',
           'Order Date'
        ] ;
    }
}
