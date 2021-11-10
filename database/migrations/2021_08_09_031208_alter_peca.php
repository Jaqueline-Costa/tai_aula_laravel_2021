<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPeca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peca', function (Blueprint $table) {
            $table->bigInteger('peca_categoria_id')->unsigned()->nullable();
            $table->foreign('peca_categoria_id')->references("id")->on('peca_categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peca', function (Blueprint $table) {
            //
        });
    }
}
