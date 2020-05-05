<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;
use App\models\order;

class IndexController extends Controller
{
    function GetIndex()
    {
        $month_now=carbon::now()->format('m');
        $year_now=carbon::now()->format('Y');
        for ($i=1; $i <= $month_now ; $i++) 
        { 
            $dl['Thang '.$i]=order::where('state',1)->whereMonth('updated_at',$i)
            ->whereYear('updated_at',$year_now)->sum('total');
        }
        $data['dl']=$dl;
        $data['so_dh']=order::count();
        return view('backend.index',$data);
    }

    function GetLogout()
    {
        Auth::logout();
        return redirect('login');
        
    }
}
