<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados', function (Blueprint $table) {
            $table->id();

            $table->string('tabela'); // social_medias, post, etc
            $table->integer('tabela_id')->unsigned(); // id na tabela de referencia
            $table->char('tipo', 16); // audiencia, dados, etc
            $table->string('subtipo')->nullable(); // M/F/U para genero; pais; cidade
            $table->string('valor', 512);

            $table->dateTime('valido_ate')->nullable();

            $table->index(['tabela_id', 'tipo'], 'idx_id_tipo');
            $table->index(['tabela_id', 'tipo', 'valido_ate'], 'idx_id_tipo_validade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados');
    }
}
