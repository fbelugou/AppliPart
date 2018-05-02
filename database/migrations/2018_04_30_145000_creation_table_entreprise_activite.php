<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableEntrepriseActivite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprise_activite', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entreprise_id');
            $table->foreign('entreprise_id')->references('id')->on('entreprise')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('activite_id');
            $table->foreign('activite_id')->references('id')->on('activite')
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
            $table->dropForeign('entreprise_activite_entreprise_id_foreign');
            $table->dropForeign('entreprise_activite_activite_id_foreign');
        });
        Schema::dropIfExists('entreprise_activite');
    }
}
