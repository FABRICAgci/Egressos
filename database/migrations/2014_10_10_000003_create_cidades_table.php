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
        Schema::create('cidades', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('uf_id');
            $table->foreign('uf_id')->references('id')->on('ufs')->onDelete('cascade');
            $table->string('name', 64);
            $table->integer('ativo')->default(1); // 1 = ativo, 2 = inativo
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cidades');
    }
};
