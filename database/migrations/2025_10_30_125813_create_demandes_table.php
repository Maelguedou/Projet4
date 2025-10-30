<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id('id_demande');
            $table->enum('type', ['salle', 'materiel']);
            $table->enum('besoin', ['projecteur', 'ordinateur', 'autre', 'aucun']);
            $table->unsignedBigInteger('matricule_enseignant');
            $table->foreign('matricule_enseignant')->references('matricule')->on('enseignants')->onDelete('cascade');
            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('cascade');
            $table->unsignedBigInteger('id_salle');
            $table->foreign('id_salle')->references('id_salle')->on('salles')->onDelete('cascade');
            $table->unsignedBigInteger('id_materiel');
            $table->foreign('id_materiel')->references('id_materiel')->on('materiels')->onDelete('cascade');
            $table->string('classe');
            $table->dateTime('date_demande');
            $table->enum('statut', ['en_attente', 'acceptee', 'refusee']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
