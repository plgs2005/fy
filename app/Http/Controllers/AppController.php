<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Influencer\Influencer\InfluencerRepository;
use App\Influencer\User\UserRepository;
use App\Influencer\Audience\AudienceComponent;
use App\Influencer\Product\ProductComponent;

class AppController extends Controller
{
    // NOTE: Vamos chamar todos os repositórios que serão necessários em cada controller
    private $influencerRepository;
    private $userRepository;

    public function __construct(
        InfluencerRepository $influencerRepository,
        UserRepository $userRepository
    )
    {
        // Como estamos passando uma classe final e não uma interface, não precisa de um ServiceProvider
        $this->influencerRepository = $influencerRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        /*
            TODO:
             - Verificar credenciais
             - Busca Roles
             - Monta menu de acordo com os roles
             - Busca notificações
             - Monta os dados que vão para a view

            DUVIDA:
             - O que vai ter no "meio" da página inicial, quando nada tiver selecionado? Dashboard?
             - Tendo um dashboard, será um módulo a parte responsável por montar dashboards?
             - Pode ser o próprio módulo HOME, onde algumas informações serão carregadas?

            OBSERVAÇÃO:
             - A página inicial vai ser a mesma para Influencer, Brand e Agency.
             - O que muda são os módulos que serão carregados no Menu, de acordo com os Roles
        */
        // Testando o Repository
        $user = $this->userRepository->fakeReturn();
        // Exemplo para o Menu, importando alguns componentes
        $components = [new AudienceComponent(), new ProductComponent()];

        // Juntando as variáveis para passar para a view
        $data = ['components' => $components, 'user' => $user];
        return view('app.home', $data);
    }

    public function config()
    {
        return view('app.config');
    }
}
