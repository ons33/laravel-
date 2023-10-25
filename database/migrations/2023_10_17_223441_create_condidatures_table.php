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
        Schema::create('condidatures', function (Blueprint $table) {
            $table->id();
                $table->string('job_title')->nullable();
                $table->string('name')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('message')->nullable();
                $table->string('cv_upload')->nullable();
                $table->string('status')->default('New');
                $table->unsignedBigInteger('offre_emploi_id')->nullable();
                $table->foreign('offre_emploi_id')->references('id')->on('offre_emplois')->onDelete('cascade');








                // Clé étrangère pour l'utilisateur
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('condidatures');
    }
};
