<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\product;

class HomeController extends Controller
{
    function GetHome() {
        $data['product_fe']=product::where('featured',1)->where('img','<>','no-img.jpg')->take(4)->get();
        $data['product_new']=product::where('img','<>','no-img.jpg')->orderby('created_at','DESC')->take(8)->get();
       return view('frontend.index',$data);
    }
    function GetContact() {
        return view('frontend.contact');
    }
      function GetAbout() {
        return view('frontend.about');
    }

}
