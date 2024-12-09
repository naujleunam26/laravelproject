<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            // Puedes continuar con la lógica según el rol
            return view('dashboard', compact('role'));
        } else {
            // Redirige al usuario a la página de inicio de sesión si no está autenticado
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }
    }
}
