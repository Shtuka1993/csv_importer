<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Maatwebsite\Excel;
use App\Http\Requests\TableFile;
use App\Imports\ProductsImports;
class FileController extends Controller {
    public function form(){
        return view('form');
    }
    //public function importFileIntoDB(TableFile $request){
    public function importFileIntoDB(Request $request){
        if($request->hasFile('table_file')){
            $path = $request->file('table_file')->getRealPath();
            //$file = $request->file('table_file');
            //$data = Excel::load($path)->get();
            //Excel::import(new ProductsImport,$file);
            $array = Excel::toArray(new ProductsImport, $path);
            var_dump($array);
            //7Excel::import(new ProductsImport, $path);
            /*if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = ['name' => $value->name, 'details' => $value->details];
                }
                if(!empty($arr)){
                    \DB::table('products')->insert($arr);
                    dd('Insert Record successfully.');
                }
            }*/
        }
        //dd('Request data does not have any files to import.');
    }
}