<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 18.08.2019
 * Time: 15:09
 */

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class AliasHelper
{

    public static function generateAlias($table, $field)
    {
        $alias = substr(md5(uniqid(rand(), true)), 0, 8);

        $isUnique = DB::table($table)->where($field, $alias)->first();

        if ($isUnique) {
            self::generateAlias($table, $field);
        } else {
            return $alias;
        }
    }
}