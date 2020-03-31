<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function listUser() {
        return view('backend.user.listuser');
    }

    function addUser() {
        return view('backend.user.adduser');
    }
    function postAddUser(AddUserRequest $r) {
        return view('backend.user.adduser');
    }

    function editUser() {
        return view('backend.user.edituser');
    }
    function editPostUser(EditUserRequest $r) {
        return view('backend.user.edituser');
    }
}
