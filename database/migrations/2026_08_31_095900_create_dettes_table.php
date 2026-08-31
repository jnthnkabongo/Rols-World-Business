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
        Schema::create('dettes', function (Blueprint $table) {
            $table->id();
            $table->string('creancier');
            $table->decimal('montant', 15, 2);
            $table->decimal('montant_payer', 15, 2)->default(0);
            $table->decimal('reste_a_payer', 15, 2);
            $table->string('statut');
            $table->string('motif');
            $table->date('date_echeance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dettes');
    }
};
