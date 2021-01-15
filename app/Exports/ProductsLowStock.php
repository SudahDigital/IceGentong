<?php

namespace App\Exports;

use App\product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsLowStock implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return product::whereRaw('stock <= low_stock_treshold')->get();
    }

    public function map($product) : array {
        return[
                $product->id,
                $product->Product_name,
                $product->description,
                $product->price,
                $product->discount,
                $product->stock,
                $product->low_stock_treshold,
                $product->status,
            ];
    }

    public function headings() : array {
        return [
           'Product_id',
           'Product_Name',
           'Description',
           'Price',
           'Discount',
           'Stock',
           'Low_stock_treshold',
           'Status',
        ] ;
    }
}
