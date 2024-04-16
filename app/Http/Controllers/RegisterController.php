<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
        //dd($request);
        // dd($request->get('username'));
         // Modificar el Request---------$request->username
        $request->request->add(['username' => Str::slug($request->username)]);
                                        
        $this->validate($request,[
            'name' => 'required|max:30',
            'username' => "required|unique:users|min:3|max:20",
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);
        //dd('Creando Usuario');
        // esto quivale a un insert into Usuario
        
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password )//encripta la contra
        ]);
        //Autenticar un Usuario
        /*auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]);*/
        //Otra forma de Autenticar 
        auth()->attempt($request->only('email','password'));
        
        //Redireccionando
        Return redirect()->route('post.index');

    }
}
