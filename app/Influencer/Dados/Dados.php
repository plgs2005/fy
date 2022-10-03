<?php

namespace App\Influencer\Dados;

use Illuminate\Database\Eloquent\Model;

abstract class Dados extends Model
{
    protected $table = 'dados';
    protected $fillable = [
        'tabela', 'tabela_id', 'tipo', 'subtipo','valor', 'valido_ate'
    ];

    public function save(array $options = [])
    {
        if(isset($options['skip'])) {
            return parent::save();    
        }

        if ($this->invalidaAntigos()) {
            return parent::save();
        }

        return false;
    }

    /**
     * Retorna VERDADEIRO para CONTINUAR o salvamento
     * Retorna FALSO para ABORTAR o salvamento
     */
    public function invalidaAntigos()
    {
        $dados = $this->toArray();
        unset($dados['valido_ate']);
        $d = get_called_class()::where($dados)->whereNull('valido_ate')->get();

        if (count($d) > 1) {
            // Não deveria ter mais de 1 valido_ate = null
            // Aborta o salvamento (com false) que deu ruim
            return false;
        }

        if (count($d) == 0) {
            // true indica que é pra continuar o salvamento
            return true;
        }

        // Aqui basicamente sobra se count == 1
        $x = $d->first();
        if ($x->estaVencido()) {
            $x->valido_ate = date('Y-m-d H:i:s');
            $x->save(['skip'=>true]);
            return true;
        }

        return false;
    }

}
