<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        /*
            TODO:
             - Entra apenas quem não tem autenticação (controlado pelas Routes)
             - Aqui deve ser só uma tela de login mesmo, sem verificações iniciais

            TAREFAS DESSE CONTROLLER:
             - Vai cuidar de comandar as integrações com as redes sociais, mas quem vai fazer o trabalho sujo serão outras classes
             - O login também poderá ser feito com email/senha? No caso do brand faz sentido, do influencer não mto
             - Pode ter algum controle de fluxo, caso o onboard não tenha sido completado
             - A princípio sempre vai redirecionar para o App, já que a Home vai ser igual sempre. A exceção seria quando o usuário clica num link estando deslogado, e após o login o sistema "lembra" da página que tentou entrar antes de logar.

            OBSERVAÇÃO:
             - 
        */
        return view('signup.home');
    }

    //Api SPA login
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(Auth::user(), 200);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.']
        ]);
    }
    //Api SPA logout
    public function logout()
    {
        Auth::logout();
    }

}
