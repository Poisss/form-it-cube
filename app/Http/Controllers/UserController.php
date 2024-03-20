<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signin(){
        return view('user.signin');
    }

    public function login(LoginRequest $request){
        if(Auth::attempt($request->validated())){
            return redirect()->route('index')->with('message','Вы авторизировались');
        }
        else{
            return redirect()->route('signin')->with('message','Неверный логин или пароль');
        }
    }
    public function create()
    {
        return view('user.create');
    }

    public function store(StoreRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('signin')->with('message','Пользователь создан');
    }
}
