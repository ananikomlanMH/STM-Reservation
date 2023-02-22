<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->timestamp("datedepart");
            $table->string("heureDepart");
            $table->string("numBillet");
            $table->integer("valise");
            $table->integer("sac");
            $table->integer("colis");
            $table->integer("gyz");
            $table->integer("siege");
            $table->string("etatVoyage");
            $table->string("alleRetour");
            $table->string("bus");
            $table->string("agent");
            $table->string("voyageur");
            $table->string("trajet");
            $table->integer("montant");
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
        Schema::dropIfExists('reservations');
    }
}
