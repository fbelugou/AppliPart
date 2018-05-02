<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableEntrepriseEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepriseEvent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('utilisateur');
            $table->date('date');
            $table->string('nature');
            $table->string('commentaire');
            $table->unsignedInteger('entreprise_id');
            $table->foreign('entreprise_id')->references('id')->on('entreprise')
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
        Schema::table('entrepriseEvent', function (Blueprint $table) {
            $table->dropForeign('entreprise_entreprise_id_foreign');
        });
        Schema::dropIfExists('entrepriseEvent');
    }
}
