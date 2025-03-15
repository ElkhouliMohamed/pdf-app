<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('top_session_pages', function (Blueprint $table) {
            $table->id('id_session_page');
            $table->string('url_page');
            $table->float('duree_moyenne');
            $table->timestamps();
            $table->unsignedBigInteger('id_rapport');
            $table->foreign('id_rapport')->references('id_rapport')->on('rapports')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('top_session_pages');
    }
};
