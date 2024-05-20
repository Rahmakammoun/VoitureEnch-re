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
        Schema::create('voitures', function (Blueprint $table) {
            $table->string('matricule')->primary();
            $table->unsignedBigInteger('idMarque');
            $table->unsignedBigInteger('idModel');
            $table->unsignedBigInteger('idVersion');
            $table->year('annee');
            $table->decimal('prix_initial', 13, 3);

            $table->text('description')->nullable();
            $table->enum('status', ['disponible', 'vendue'])->default('disponible');
            $table->unsignedBigInteger('proprietaire_id')->nullable();
            $table->foreign('proprietaire_id')->references('id')->on('users')->onDelete('set null');
            $table->string('image');

            $table->foreign('idMarque')->references('id')->on('marques');
            $table->foreign('idModel')->references('id')->on('models');
            $table->foreign('idVersion')->references('id')->on('versions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voitures');
    }
};
