<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->text('nome_cliente');
            $table->string('cidade');
            $table->char('estado', 2);
            $table->char('rastreio', 13); //  6 (data) + 2 (estado) + 5 (sequência)
            $table->dateTime('data_venda');
            $table->decimal('valor',18,2);
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
