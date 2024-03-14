<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLogin()
    {
        // $usuario = new Usuario();

        // $usuario->username = "ealbuja2";
        // $usuario->password = \bcrypt("pepe");

        // $usuario->save();º

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $user_password = $request->input('password');

        $user = Usuario::where('username', $username)->first();

        if ($user != null && Hash::check($user_password, $user->password)) {
            Auth::login($user);
            $response = redirect('/main');
        } else {
            $request->session()->flash('error','Usuario o contraseña incorrectos');
            $response = redirect('/login')->withInput();
        }

        return $response;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
