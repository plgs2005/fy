<?php

namespace App\Influencer\Dados\Audiencia;

use App\Influencer\Dados\Dados;

class Audiencia extends Dados
{

    public function __construct()
    {
        $this->tabela = 'social_medias';
    }

    public function traduzirDados($socialMediaId, $tipo, $subtipo, $valor)
    {
        $this->tabela_id = $socialMediaId;
        $this->tipo = $tipo;
        $this->subtipo = $subtipo;
        $this->valor = $valor;
        // $this->configuraValidade();
    }

    /**
     * Retorna VERDADEIRO se a informação atual precisa ser atualizada
     * Retorna FALSO se a informação atual ainda é válida
     */
    public function estaVencido()
    {
        if (in_array($this->tipo, ['sex', 'age', 'country', 'city'])) {
            return $this->created_at < date('Y-m-d H:i:s', strtotime('-1 day'));
        }
    }
}
