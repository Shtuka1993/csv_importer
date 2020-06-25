<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\TableFile;
use App\Imports\ProductsImport;

class FileController extends Controller
{
    public function form()
    {
        return view('form');
    }

    public function importFileIntoDB(TableFile $request)
    {
        if ($request->hasFile('table_file')) {
            $path = $request->file('table_file')->getRealPath();
            $productsImport = new ProductsImport;
            try {
                Excel::import($productsImport, $path);

                echo "<h2>Count Of Processed Rows - ".$productsImport->processed."</h2>";

                echo "<h2>Count of Failed Rows - ".$productsImport->failed."</h2>";
                echo "<h2>Count of Added Rows - ".$productsImport->added."</h2>";

            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();

                echo '<table>';
                foreach ($failures as $failure) {
                    echo '<tr>';
                    echo '<td>'.$failure->row().'</td>';
                    echo '<td>'.$failure->attribute().'</td>';
                    echo '<td>'.implode("|",$failure->errors()).'</td>';
                    echo '<td>'.implode("|",$failure->values()).'</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
    }
}