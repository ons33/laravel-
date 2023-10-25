
<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('duree');
            $table->string('salaire');
            $table->string('date_debut');
            $table->string('date_fin');
            $table->string('description');
            $table->string('etat');
            $table->unsignedBigInteger('user_id');  // Clé étrangère vers l'utilisateur
            $table->unsignedBigInteger('offre_emploi_id'); 
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('offre_emploi_id')->references('id')->on('offre_emplois')->onDelete('cascade');
            $table->unsignedBigInteger('condidature_id');
            $table->foreign('condidature_id')->references('id')->on('condidatures')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrats');
    }
};
