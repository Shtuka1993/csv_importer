<?php
/**
 * Created by PhpStorm.
 * User: Shtuka
 * Date: 23.06.2020
 * Time: 21:42
 */


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
class SiteController extends Controller {
    public function getMaxFileSize(){
        $max_upload = (int)(ini_get('upload_max_filesize'));
        $max_post = (int)(ini_get('post_max_size'));
        $memory_limit = (int)(ini_get('memory_limit'));
        $upload_mb = min($max_upload, $max_post, $memory_limit);

        return $upload_mb;
    }
}