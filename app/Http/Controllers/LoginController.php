<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function show_login_form()
    {
        return view('login');
    }

    public function process_login(Request $request)
    {
        if(in_array($request->perfil, ['egresso', 'administrador']))
        {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1])) {

                if(Auth::user()->perfil == 1 && $request->perfil == 'egresso')
                {
                    return redirect()->route('logout', ['message' => 'Acesso Indevido! Escolha o perfil correto',]);
                }

                if(Auth::user()->perfil == 2 && $request->perfil == 'administrador')
                {
                    return redirect()->route('logout', ['message' => 'Acesso Indevido! Escolha o perfil correto',]);
                }

                $request->session()->regenerate();
                return redirect()->route('dashboard-ecommerce');  
            }
        }
 
        return back()->with(['message' => 'Credenciais Inválidas!',]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if($request->message)
        {
            return redirect('login')->with(['message' => $request->message,]);
        }

        return redirect('login');
    }
}
