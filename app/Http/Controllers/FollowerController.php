<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    // user es el usuario a quien voy a seguir
    public function store(User $user)
    {  // dd($user->username);
        //relacion de muchos a muchos el attach
        $user->followers()->attach( auth()->user()->id );
        return back();
    }
    
    public function destroy(User $user)
    {
        $user->followers()->detach( auth()->user()->id );
        return back();
    }
    
}
