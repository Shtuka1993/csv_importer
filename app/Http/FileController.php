<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\TableFile;
use App\Imports\ProductsImport;
class FileController extends Controller {
    public function form(){
        return view('form');
    }
    public function importFileIntoDB(TableFile $request){
        if($request->hasFile('table_file')){
            $path = $request->file('table_file')->getRealPath();
            Excel::import(new ProductsImport, $path);
        }
    }
}