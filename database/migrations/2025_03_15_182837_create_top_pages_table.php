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
        Schema::create('top_pages', function (Blueprint $table) {
            $table->id('id_page');
            $table->string('url_page');
            $table->integer('nombre_visites');
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
        Schema::dropIfExists('top_pages');
    }
};
