<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 18.08.2019
 * Time: 12:26
 */
namespace App\Http\Controllers;

use App\Models\Link;



class DefaultController extends Controller
{

    public function shortenLink($alias)
    {
        $find = Link::where('alias', $alias)->first();

        return $find ? redirect($find->url) : abort(404);
    }
}