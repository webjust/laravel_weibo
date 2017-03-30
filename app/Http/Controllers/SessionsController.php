<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class SessionsController extends Controller
{
    // 登录视图
    public function create()
    {
        return view('sessions.create');
    }
    
    // 登录判断
    public function store(Request $request)
    {
        // 数据校验
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        // 用户认证Auth
        $credentials = [
             'email' => $request->email,
             'password' => $request->password,
        ];

        if(Auth::attempt($credentials)){
            // 成功后，返回信息，并跳转至信息显示页面
            session()->flash('success', '欢迎回来');
            return redirect()->route('users.show', [Auth::user()]);
        }else {
            session()->flash('danger', '抱歉，您的邮箱和密码不匹配');
            return redirect()->back();
        }
    }
}
