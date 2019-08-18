<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 18.08.2019
 * Time: 12:26
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;



class DefaultController extends Controller
{
    public function index()
    {
        $shortLinks = Link::latest()->get();

        return view('default', compact('shortLinks'));
    }

    public function store(Request $request)
    {
        //dump($request);die;
        $this->validate($request, [
            'url' => ['required','url','unique:links','max:255', new \App\Rules\ResourceExists]
        ]);

        $urlSaved = Link::create([
            'url' => $request->url
        ]);

        if($urlSaved){
            $alias = substr(md5($urlSaved->id . str_random(3)), 0, -20);
            Link::where(['id' => $urlSaved->id])->update([
                'alias' => $alias
            ]);
        }

        return redirect('/')
            ->with('success', 'Shorten Link Generated Successfully!');
    }


    public function shortenLink($alias)
    {
        $find = Link::where('alias', $alias)->first();

        return redirect($find->url);
    }
}