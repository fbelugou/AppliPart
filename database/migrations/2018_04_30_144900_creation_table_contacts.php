<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contactAMIO')->nullable();
            $table->date('date')->nullable();
            $table->string('nature')->nullable();
            $table->text('commentaire')->nullable();
            $table->unsignedInteger('entreprise_id')->nullable();
            $table->foreign('entreprise_id')->references('id')->on('entreprises')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::table('contacts', function(Blueprint $table) {
            $table->dropForeign('contacts_entreprise_id_foreign');
            $table->dropForeign('contacts_interlocuteur_id_foreign');
        });
        Schema::dropIfExists('contacts');
    }
}
