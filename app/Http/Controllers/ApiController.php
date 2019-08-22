<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 18.08.2019
 * Time: 12:26
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;


class ApiController extends Controller
{
    public function index()
    {
        return Link::latest()->get();
    }

    public function store(Request $request)
    {
        $rules = [
            'url' => ['required', 'url', 'unique:links', 'max:255', new \App\Rules\ResourceExists],
        ];
        $link = [
            'url' => $request->url,
        ];

        if ($request->alias) {
            $rules['alias'] = ['required', 'unique:links', 'max:8'];
            $link['alias'] = $request->alias;
        } else {
            $link['alias'] = \App\Helpers\AliasHelper::generateAlias('links','alias');
        }
        $this->validate($request, $rules);

        $urlSaved = Link::create($link);

        return response()->json($urlSaved, 201);
    }


    public function getUrl($alias)
    {
        $find = Link::where('alias', $alias)->first();
        return response()->json($find->url, 201);
    }
}