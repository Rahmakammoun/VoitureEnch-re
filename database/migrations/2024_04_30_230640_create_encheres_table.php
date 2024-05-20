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
    Schema::create('encheres', function (Blueprint $table) {
        $table->id();
        $table->string('voiture_id');
        $table->foreign('voiture_id')->references('matricule')->on('voitures')->onDelete('cascade');
        
        $table->unsignedBigInteger('utilisateur_id')->nullable();
        $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
        
        $table->decimal('prix_enchere', 13, 3);
        $table->integer('temps_restant');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encheres');
    }
};
