<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        // validar (si pasa la validacion entonces tiene atributos validados que serviran para la creacion
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);
        // crear el usuario
        $user = User::create($attributes);
        // loguearse
        Auth::login($user);
        // redirigir a algun lado
        return redirect('/jobs');
    }
}
