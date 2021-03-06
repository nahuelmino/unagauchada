<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGauchadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gauchadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creado_por')->unsigned();
            //$table->foreign('creado_por')->references('id')->on('users');
            $table->integer('categoria_id')->unsigned();
            //$table->foreign('categoria')->references('id')->on('gauchada_categorias');
            $table->integer('aceptado')->unsigned()->nullable()->default(null);
            //$table->foreign('aceptado')->references('id')->on('users');
            $table->integer('calificacion_id')->unsigned()->nullable()->default(null);
            $table->string('title');
            $table->longText('description');
            $table->string('location');
            $table->string('photo')->nullable()->default(null);
            $table->timestamp('ends_at');
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
        Schema::dropIfExists('gauchadas');
    }
}
