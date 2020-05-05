<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\models\customer;
use Carbon\Carbon;
class LoginController extends Controller
{
    function GetLogin()
    {
        return view('backend.login.login');
    }

    function PostLogin(LoginRequest $r)
    {
       
        if ( Auth::attempt(['email' => $r->email, 'password' => $r->password])) 
        {
            return redirect('admin');
        }
        else {
            return redirect('login')->withInput()->with('thongbao','Tài khoản hoặc mật khẩu không chính xác!');
        }
    }

    function Logout()
    {
        Auth::logout();
        return redirect('login');
    }

    function GetIndex()
    {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        for ($i=1; $i <= $month; $i++) 
        { 
            $monthjs[$i]='Thang '.$i;
            $numberjs[$i]=customer::where('state',1)->whereMonth('updated_at',$i)->whereYear('updated_at',$year)->sum('total');
        }
        $data['monthjs'] = $monthjs;
        $data['numberjs'] = $numberjs;
        $data['order'] = customer::where('state',0)->count();
        return view('backend.index',$data);
    }
}
