<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableEntreprises extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->boolean('partenaireRegulier');
            $table->boolean('siegeSocial');
            $table->integer('taille')->nullable();
            $table->string('rue')->nullable();
            $table->string('ville')->nullable();
            $table->string('cp')->nullable();
            $table->string('siteWeb')->nullable();
            $table->string('telephone')->nullable();
            $table->text('commentaire')->nullable();
            $table->unsignedInteger('groupe_id')->nullable();
            $table->foreign('groupe_id')->references('id')->on('groupes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('coord_id')->nullable();
            $table->foreign('coord_id')->references('id')->on('coordonees')->onDelete('cascade')
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
        Schema::table('entreprises', function(Blueprint $table) {
            $table->dropForeign('entreprises_groupe_id_foreign');
            $table->dropForeign('entreprises_coord_id_foreign');
        });
        Schema::dropIfExists('entreprises');
    }
}
