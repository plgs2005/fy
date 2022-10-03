<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index()
    {
        /*
            TODO:
             - Entra apenas quem não tem autenticação (controlado pelas Routes)
             - Aqui deve ser só uma tela de início de cadastro mesmo, sem verificações iniciais

            TAREFAS DESSE CONTROLLER:
             - Todas as telas de passos intermediários serão comandadas por aqui
             - No influencer, vamos guiá-lo para selecionar hashtags, brands, etc
             - No brand, vamos fazer ele preencher todos os campos necessários, em vários passos
             - Ao final, com tudo confirmado, podemos mandar o usuário pro AppController
             - Teremos algumas flags e integrações com o Intercom para o onboard, que será feito já no AppController
             - Eventualmente, caso algum passo intermediário do cadastro não tenha sido feito, podemos mandar o usuário direto para esse passo depois que ele fizer o login. Nesse caso, precisaria de um controle no BD.

            OBSERVAÇÃO:
             - 
        */
        return view('signup.home');
    }

}
