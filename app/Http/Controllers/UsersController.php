<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;

class UsersController extends Controller
{
     public function create()
     {
         return view('users.create');
     }

     public function show($id)
     {
         $user = User::findOrFail($id);
         return view('users.show', compact('user'));
     }

     public function store(Request $request)
     {
         // 数据校验
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required'
        ]);

        // 写入数据库
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // 跳转
        return redirect()->route('users.show', $user);
     }
}
