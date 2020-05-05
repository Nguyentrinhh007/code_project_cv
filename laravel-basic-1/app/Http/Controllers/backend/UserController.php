<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{AddUserRequest,EditUserRequest};
use App\User;

class UserController extends Controller
{
    function ListUser()
    {
        $data['users'] = User::paginate(3);
        return view('backend.user.listuser',$data);
    }

    function GetAddUser()
    {
        return view('backend.user.adduser');
    }

    function PostAddUser(AddUserRequest $r)
    {
        $user = new User;
        $user->email=$r->email;
        $user->password=bcrypt($r->password);
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect('admin/user')->with('thongbao','Đã thêm thành công thành viên!');
    }

    function GetEditUser($id_user)
    {
        $data['user'] = User::find($id_user);
        return view('backend.user.edituser',$data);
    }

    function PostEditUser(EditUserRequest $r,$id_user)
    {
        $user=user::find($id_user);
        $user->email=$r->email;
        if ($r->password!="") 
        {
            $user->password=bcrypt($r->password);
        }
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect()->back()->with('thongbao','Đã sửa thành công!');
    }
    
    function DelUser($id_user)
    {
        User::destroy($id_user);
        return redirect()->back()->with('thongbao','Xóa thành công thành viên!');
    }
}
