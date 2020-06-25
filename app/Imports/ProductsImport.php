<?php

namespace App\Imports;

use App\Product;
use App\Category;
use App\InnerCategory;
use App\Subcategory;
use App\Manufacturer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

class ProductsImport implements ToModel, WithStartRow, WithValidation, SkipsOnFailure
{

    //public $count = $this->getRowCount();
    public $processed = 0;
    public $failed = 0;
    //public $dublicate = 0;
    public $added = 0;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $this->processed++;

        $manufacturer = Manufacturer::firstOrCreate(['name'=>$row[3]]);

        $category1 = Category::firstOrCreate(['name' => $row[0]]);
        $category2 = InnerCategory::firstOrCreate(['name' => $row[1], 'category_id'=>$category1->id]);

        $subcategory = Subcategory::firstOrCreate(['name'=>$row[2], 'category_id'=>$category1->id]);


        $product = new Product([
        //$product = Product::firstOrCreate([
            'manufacturer_id' => $manufacturer->id,
            'subcategory_id' => $subcategory->id,

            'name' => $row[4]??'--- NO NAME ---',
            'article' => $row[5],
            'description' => $row[6],
            'price' => $row[7],
            'guarantee' => (!$row[8] || $row[8] == 'Нет') ? 0 : $row[8],
            'available' => ($row[9] == 'есть в наличие') ? true : false,
        ]);
        if(!$product->wasRecentlyCreated) {
            //$this->dublicate++;
        } else {
            $this->added++;
        }
        return $product;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '0' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('No category 1');
                } else if(!is_string($value)){
                    $onFailure('Incorrect data for category 1');
                }
            },
            '1' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('No category 2');
                } else if(!is_string($value)){
                    $onFailure('Incorrect data for category 2');
                }
            },
            '2' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('No subcategory');
                } else if(!is_string($value)){
                    $onFailure('Incorrect data for subcategory');
                }
            },
            '3' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('No manufacturer');
                } else if(!is_string($value)){
                    $onFailure('Incorrect data for manufacturer');
                }
            },
            '4' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('Name is empty');
                } else if(!is_string($value)){
                    $onFailure('Incorrect data for name');
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
                } else if(!is_string($value)){
                    $onFailure('Incorrect data for description');
                }
            },
            '7' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('Price is empty');
                } else if(!is_int($value)){
                    $onFailure('Incorrect data for price');
                }
            },
            '8' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('No guarantee');
                } else if(!is_string($value)){
                    $onFailure('Incorrect data for guarantee');
                }
            },
            '9' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('Not available');
                } else if(!is_string($value)){
                    $onFailure('Incorrect data for available');
                }
            },
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $this->failed++;
        /*echo '<table style="height: 150px; border: 3px solid black; overflow: auto;">';
        foreach ($failures as $failure) {
            echo '<tr>';
            echo '<td>'.$failure->row().'</td>'; // row that went wrong
            echo '<td>'.$failure->attribute().'</td>'; // either heading key (if using heading row concern) or column index
            echo '<td>'.implode("|",$failure->errors()).'</td>'; // Actual error messages from Laravel validator
            echo '<td>'.implode("|",$failure->values()).'</td>'; // The values of the row that has failed.
            echo '</tr>';
        }
        echo '</table>';*/
    }
}
