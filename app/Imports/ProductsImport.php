<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithStartRow//, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return Product::firstOrCreate([
            'manufacturer_id' => 1,
            'subcategory_id' => 1,

            'name' => $row[4]??'--- NO NAME ---',
            'article' => $row[5],
            'description' => $row[6],
            'price' => $row[7],
            'guarantee' => (!$row[8] || $row[8] == 'Нет') ? 0 : $row[8],
            'available' => ($row[9] == 'есть в наличие') ? true : false,
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    /*public function rules(): array
    {
        return [
            '0' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('No category 1');
                }
            },
            '1' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('No cutegory 2');
                }
            },
            '2' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('No subcategory');
                }
            },
            '3' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('No manufacturer');
                }
            },
            '4' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('Name is empty');
                }
            },
            '5' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('Article is empty');
                }
            },
            '6' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('Description is empty');
                }
            },
            '7' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('Price is empty');
                }
            },
            '8' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('No guarantee');
                }
            },
            '9' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('Not available');
                }
            },
        ];
    }*/
}
