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
        Schema::create('erreurs_404', function (Blueprint $table) {
            $table->id('id_404');
            $table->integer('nb_404');
            $table->string('file_data');
            $table->timestamps();

            // Foreign key to the `rapports` table
            $table->unsignedBigInteger('id_rapport');
            $table->foreign('id_rapport')->references('id_rapport')->on('rapports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erreurs_404');
    }
};
