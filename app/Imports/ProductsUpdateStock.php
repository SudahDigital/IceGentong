<?php

namespace App\Imports;

use App\product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsUpdateStock implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new product([
            'id'=>$row['Product_id'],
            'Product_name' => $row['Product_Name'],
            'description' => $row['Description'],
            'price'=>$row['Price'],
            'discount'=>$row['Discount'],
            'stock' => $row['stock'],
            'low_stock_treshold'=>$row['Low_stock_treshold'],
            'status'=>$row['Status']
        ]);
    }
}
