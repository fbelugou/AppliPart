<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableEntrepriseFiliere extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprise_filiere', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entreprise_id');
            $table->foreign('entreprise_id')->references('id')->on('entreprise')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('filiere_id');
            $table->foreign('filiere_id')->references('id')->on('filiere')
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
            $table->dropForeign('entreprise_filiere_entreprise_id_foreign');
            $table->dropForeign('entreprise_filiere_filiere_id_foreign');
        });
        Schema::dropIfExists('entreprise_filiere');
    }
}
