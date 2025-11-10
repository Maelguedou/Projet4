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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->json('type')->nullable();
            $table->string('besoin')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->unsignedBigInteger('id_salle')->nullable();
            $table->foreign('id_salle')->references('id_salle')->on('salles')->onDelete('restrict');
            $table->unsignedBigInteger('id_materiel')->nullable();
            $table->foreign('id_materiel')->references('id_materiel')->on('materiels')->onDelete('restrict');
            $table->string('classe');
            $table->timestamp('date_demande');
            $table->enum('statut', ['en_attente', 'acceptee', 'refusee','terminee'])->default('en_attente');
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
