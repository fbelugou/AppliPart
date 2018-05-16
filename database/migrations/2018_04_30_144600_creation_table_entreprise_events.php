<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableEntrepriseEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepriseEvents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('utilisateur');
            $table->date('date');
            $table->string('nature');
            $table->text('commentaire');
            $table->unsignedInteger('entreprise_id')->nullable();
            $table->foreign('entreprise_id')->references('id')->on('entreprises')
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
        Schema::table('entrepriseEvents', function (Blueprint $table) {
            $table->dropForeign('entreprises_entreprise_id_foreign');
        });
        Schema::dropIfExists('entrepriseEvents');
    }
}
