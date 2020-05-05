<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\{product,category};

class IndexController extends Controller
{
    function GetIndex()
    {
        $data['prd_new']=product::where('img','<>','no-img.jpg')->orderBy('id','desc')->take(8)->get();
        $data['prd_nb']=product::where('img','<>','no-img.jpg')->where('state',1)->take(4)->get();
        return view('frontend.index',$data);
    }

    function GetPrdSlug($slug_cate)
    {
        $data['products']=category::where('slug',$slug_cate)->first()->prd()->paginate(6);
        $data['categorys']=category::all();
        return view('frontend.product.shop',$data);
    }

    function GetFilter(request $r)
    {
        $data['products']=product::whereBetween('price',[$r->start,$r->end])->paginate(6);
        $data['categorys']=category::all();
        return view('frontend.product.shop',$data);
    }

    function GetAbout()
    {
        return view('frontend.about');
    }

    function GetContact()
    {
        return view('frontend.contact');
    }
}
