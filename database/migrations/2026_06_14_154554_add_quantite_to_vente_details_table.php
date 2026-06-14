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
        Schema::table('vente_details', function (Blueprint $table) {
            $table->integer('quantite')->default(1)->after('produit_unite_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vente_details', function (Blueprint $table) {
            $table->dropColumn('quantite');
        });
    }
};
