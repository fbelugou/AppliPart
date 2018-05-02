<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableEntreprise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprise', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->boolean('partenaireRegulier');
            $table->boolean('siegeSocial');
            $table->string('adresse');
            $table->integer('taille');
            $table->string('rue');
            $table->string('ville');
            $table->string('cp');
            $table->string('siteWeb');
            $table->string('telephone');
            $table->string('commentaire');
            $table->unsignedInteger('groupe_id');
            $table->foreign('groupe_id')->references('id')->on('groupe')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('event_id');
            $table->foreign('event_id')->references('id')->on('entreprise_event')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('coord_id');
            $table->foreign('coord_id')->references('id')->on('coordonees')
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
        Schema::table('entreprise', function(Blueprint $table) {
            $table->dropForeign('entreprise_groupe_id_foreign');
            $table->dropForeign('entreprise_event_id_foreign');
            $table->dropForeign('entreprise_coord_id_foreign');
        });
        Schema::dropIfExists('entreprise');
    }
}
