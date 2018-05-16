<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableEntreprisesActivites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises_activites', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entreprise_id')->nullable();
            $table->foreign('entreprise_id')->references('id')->on('entreprises')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('activite_id')->nullable();
            $table->foreign('activite_id')->references('id')->on('activites')
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
        Schema::table('entreprises_activites', function(Blueprint $table) {
            $table->dropForeign('entreprises_activites_entreprise_id_foreign');
            $table->dropForeign('entreprises_activites_activite_id_foreign');
        });
        Schema::dropIfExists('entreprises_activites');
    }
}
