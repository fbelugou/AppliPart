<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableInterlocuteur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interlocuteur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prenom');
            $table->string('nom');
            $table->string('fonction');
            $table->string('telFixe');
            $table->string('telMobile');
            $table->string('mail');
            $table->string('commentaire');
            $table->boolean('transmission');
            $table->unsignedInteger('event_id');
            $table->foreign('event_id')->references('id')->on('interlocuteur_event')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::table('interlocuteur', function (Blueprint $table) {
            $table->dropForeign('interlocuteur_event_id_foreign');
        });
        Schema::dropIfExists('interlocuteur');
    }
}
