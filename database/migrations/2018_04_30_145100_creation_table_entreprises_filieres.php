<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableEntreprisesFilieres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises_filieres', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entreprise_id')->nullable();
            $table->foreign('entreprise_id')->references('id')->on('entreprises')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('filiere_id')->nullable();
            $table->foreign('filiere_id')->references('id')->on('filieres')
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
        Schema::table('entreprises_filieres', function(Blueprint $table) {
            $table->dropForeign('entreprises_filieres_entreprise_id_foreign');
            $table->dropForeign('entreprises_filieres_filiere_id_foreign');
        });
        Schema::dropIfExists('entreprises_filieres');
    }
}
