<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('offre_emplois', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('emplacement');
        $table->string('Type');
        $table->text('apropos');
        $table->float('salaire');
        $table->timestamps();
        $table->unsignedBigInteger('societe_id')->nullable();
        $table->foreign('societe_id')->references('id')->on('societes');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offre_emplois');
    }
};
