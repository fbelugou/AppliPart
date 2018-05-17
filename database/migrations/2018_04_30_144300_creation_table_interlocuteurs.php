<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableInterlocuteurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interlocuteurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prenom')->nullable();
            $table->string('nom');
            $table->string('civilite')->nullable();
            $table->string('fonction')->nullable();
            $table->string('telFixe')->nullable();
            $table->string('telMobile')->nullable();
            $table->string('mail')->nullable();
            $table->text('commentaire')->nullable();
            $table->boolean('transmission');
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
        Schema::dropIfExists('interlocuteurs');
    }
}
