<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contactAMIO');
            $table->date('date');
            $table->string('objet');
            $table->string('commentaire');
            $table->unsignedInteger('entreprise_id');
            $table->foreign('entreprise_id')->references('id')->on('entreprise')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::table('contact', function(Blueprint $table) {
            $table->dropForeign('contact_entreprise_id_foreign');
            $table->dropForeign('contact_interlocuteur_id_foreign');
        });
        Schema::dropIfExists('contact');
    }
}
