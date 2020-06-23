<?php
/**
 * Created by PhpStorm.
 * User: Shtuka
 * Date: 23.06.2020
 * Time: 20:04
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    public $fillable = ['name'];
}