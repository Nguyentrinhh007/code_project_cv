<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\{product,category};
class ProductController extends Controller
{
    function GetShop()
    {
        $data['products']=product::paginate(6);
        $data['categorys']=category::all();
        return view('frontend.product.shop',$data);
    }

    function GetDetail($slug_prd)
    {
        $data['prd']=product::where('slug',$slug_prd)->first();
        $data['prd_new']=product::where('img','<>','no-img.jpg')->orderBy('id','desc')->take(4)->get();

        return view('frontend.product.detail',$data);
    }

}
