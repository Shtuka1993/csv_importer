<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Product::firstOrCreate([
            'name'     => $row[4],
            'article'    => $row[5],
            'description'    => $row[6],
            'price'    => $row[7],
            'guarantee'    => ($row[8] || $row[8]=='Нет') ? 0 : $row[8],
            'available'    => ($row[9]=='есть в наличие') ? true : false,
        ]);
    }
}
