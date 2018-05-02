<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableInterlocuteurEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interlocuteurEvent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('utilisateur');
            $table->date('date');
            $table->string('nature');
            $table->string('commentaire');
            $table->unsignedInteger('interlocuteur_id');
            $table->foreign('interlocuteur_id')->references('id')->on('interlocuteur')
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
        Schema::table('interlocuteurEvent', function (Blueprint $table) {
            $table->dropForeign('interlocuteur_interlocuteur_id_foreign');
        });
        Schema::dropIfExists('interlocuteurEvent');
    }
}
