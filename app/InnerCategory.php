<?php
/**
 * Created by PhpStorm.
 * User: Shtuka
 * Date: 23.06.2020
 * Time: 20:04
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
class InnerCategory extends Model
{
    public $fillable = ['name', 'category_id'];
}