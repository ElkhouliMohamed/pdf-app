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
        Schema::create('top_keywords', function (Blueprint $table) {
            $table->id('id_keyword'); // Create an auto-incrementing ID as primary key
            $table->string('keyword'); // Store the keyword
            $table->integer('nombre_requetes'); // Store the number of requests

            // Foreign key to the `rapports` table
            $table->unsignedBigInteger('id_rapport'); // Unsigned big integer for foreign key
            $table->foreign('id_rapport')->references('id_rapport')->on('rapports')->onDelete('cascade'); // Foreign key constraint

            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_keywords');
    }
};
