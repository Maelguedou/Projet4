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
        Schema::table('materiels', function (Blueprint $table) {
            $table->foreignId('id_demande')->nullable()->constrained('demandes','id_demande');
        });
    }

    /**
     * Reverse the migrations.
     */

//     définit ce qui se passe si on annule la migration (php artisan migrate:rollback)

// Permet de revenir en arrière proprement, sans casser la base de données.
    public function down(): void
    {
        Schema::table('materiels', function (Blueprint $table) {
            $table->dropForeign(['id_demande']);
            $table->dropColumn('id_demande');
        });
    }
};
