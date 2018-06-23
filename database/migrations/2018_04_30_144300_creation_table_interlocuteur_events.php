<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableInterlocuteurEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interlocuteurEvents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('utilisateur');
            $table->date('date');
            $table->string('nature');
            $table->text('commentaire')->nullable();
            $table->unsignedInteger('interlocuteur_id')->nullable();
            $table->foreign('interlocuteur_id')->references('id')->on('interlocuteurs')
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
        Schema::table('interlocuteurEvents', function (Blueprint $table) {
            $table->dropForeign('interlocuteurs_interlocuteur_id_foreign');
        });
        Schema::dropIfExists('interlocuteurEvents');
    }
}
