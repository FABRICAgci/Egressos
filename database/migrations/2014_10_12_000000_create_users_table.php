<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('countrie_nascimento')->nullable();
            $table->unsignedBigInteger('uf_nascimento')->nullable();
            $table->unsignedBigInteger('cidade_nascimento')->nullable();
            $table->unsignedBigInteger('countrie_mora')->nullable();
            $table->unsignedBigInteger('uf_mora')->nullable();
            $table->unsignedBigInteger('cidade_mora')->nullable();
            $table->unsignedBigInteger('titulo_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->string('outro')->nullable();
            $table->string('name');
            $table->year('ano_ingresso')->nullable();
            $table->year('ano_formatura')->nullable();
            $table->date('dt_nascimento')->nullable();
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->string('endereco')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('perfil')->default(2); // 1 = administrador, 2 = egresso
            $table->integer('ativo')->default(1); // 1 = ativo, 2 = inativo
            $table->string('imagem')->nullable();
            $table->string('funcao')->nullable();
            $table->string('empresa')->nullable();
            $table->unsignedBigInteger('criador');
            $table->unsignedBigInteger('modificador');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('titulo_id')->references('id')->on('titulos')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
