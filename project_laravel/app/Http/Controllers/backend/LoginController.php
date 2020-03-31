<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
// use DB;
use App\models\{users,customer};
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoginController extends Controller
{
    function getLogin() {
        return view('backend.login.login');
    }
    function postLogin(LoginRequest $r) {

        // if(DB::table('users')->where('email',$r->email)->where('password',$r->password)->count()>0) //dùng DB
        // if(users::where('email',$r->email)->where('password',$r->password)->count()>0)     //dùng model

        if(Auth::attempt(['email' => $r->email, 'password' => $r->password]))     //dùng model


            {
            // session()->put('email',$r->email);   // Auth đã hỗ trợ nên không cần

            return redirect('admin');
        }
        else{
            //giữ lại giá trị email khi trả về login nếu mật khẩu sai
            return redirect('login')->withInput()->with('thongbao','Mật khẩu hoặc email của bạn không chính xác!');

        }
        // return view('backend.login.login');
    }

    function getIndex() {
        $year_n=Carbon::now()->format('Y');
        $month_n=Carbon::now()->format('m');
        for($i=1;$i<13;$i++)
        {
           $monthjs[$i]='Tháng '.$i;
           $numberjs[$i]=customer::where('state',1)->whereMonth('updated_at',$i)->whereYear('updated_at', $year_n)->sum('total');
        }
        $data['monthjs']=$monthjs;
        $data['numberjs']=$numberjs;
        $data['order']=customer::where('state',0)->count();
         return view('backend.index',$data);
            }

    function getLogout() {
        //xóa session
        // session()->forget('email');
        //cách 1
        Auth::logout();
        return redirect('login');
        // //cách 2
        // return view('backend.login.login');

    }
}
