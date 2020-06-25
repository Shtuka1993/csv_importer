<?php
/**
 * Created by PhpStorm.
 * User: Shtuka
 * Date: 23.06.2020
 * Time: 20:03
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    public $fillable = ['category1','category2','manufacturer_id','subcategory_id','name','article','description','price','guarantee','available'];
}