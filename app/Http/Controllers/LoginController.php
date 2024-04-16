<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//aqui el user se va a logear
class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {   //   dd($request->remenber);
        //dd('autenticando');
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
         
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('mensaje','Credenciales Incorrectas');
        //el  back hace que regrese a una vista y enviemos ese error
        }
        /*
         if(!auth()->attempt($request->only('email', 'password'), $request->remember ) ) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }
         */
        return redirect()->route('posts.index', auth()->user()->username );
    }
}
