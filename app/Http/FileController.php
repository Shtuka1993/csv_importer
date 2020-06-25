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
            //try {
                Excel::import(new ProductsImport, $path);
            /*} catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();

                foreach ($failures as $failure) {
                    $failure->row(); // row that went wrong
                    $failure->attribute(); // either heading key (if using heading row concern) or column index
                    $failure->errors(); // Actual error messages from Laravel validator
                    $failure->values(); // The values of the row that has failed.
                }
            }*/
        }
    }
}