<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'code' => $row['code'],
            'purchase_price' => $row['purchase_price'],
            'sales_price' => $row['sales_price'],
            'quantity' => $row['quantity'],
            'unit_of_measure_id' => $row['unit_of_measure_id'],
            'description' => $row['description'],
            'account_id' => Auth::user()->account_id,
        ]);
    }
}
