<?php

namespace App\Influencer\Dados\DadosPost;

use App\Influencer\Dados\Dados;

use Illuminate\Database\Eloquent\Model;

class DadosPost extends Dados
{

    public function __construct()
    {
        $this->tabela = 'post';
    }

    public function post()
    {
        $this->belongsTo('App\Influencer\Post\Post');
    }

    public function traduzirDados($postId, $insight)
    {
        $this->tabela_id = $postId;
        $this->tipo = $insight['name'];
        $this->valor = $insight['values'][0]['value'];
    }

    /**
     * Retorna VERDADEIRO se a informação atual precisa ser atualizada
     * Retorna FALSO se a informação atual ainda é válida
     */
    public function estaVencido()
    {
        return $this->valido_ate < date('Y-m-d H:i:s');
    }

    public function setarValidade($validade = 2)
    {
        // Aqui ficam as regras de validade de um objeto.
        // As regras já foram discutidas no Slack, mas precisam ser implementadas.
        if (in_array($this->tipo, ['impressions', 'reach', 'engagement', 'saved', 'comments_count', 'like_count', 'taps_back', 'taps_forward', 'exits', 'replies'])) {
            $this->valido_ate = date('Y-m-d H:i:s', strtotime("+{$validade} minutes"));
        } else if (in_array($this->tipo, ["media_url"])) {
            $this->valido_ate = date('Y-m-d H:i:s', strtotime('+10 years'));
        }
    }

}
