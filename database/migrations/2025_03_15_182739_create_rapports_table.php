<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->id('id_rapport');
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('id_projet');
            $table->string('nom_rapport');
            $table->date('periode');
            $table->integer('total_clicks');
            $table->integer('total_impressions');
            $table->float('avg_ctr', 5, 2); // e.g., 99.99%
            $table->float('avg_position', 5, 2); // e.g., 99.99
            $table->integer('nb_sessions');
            $table->integer('nb_active_users');
            $table->integer('nb_new_users');
            $table->float('page_speed', 5, 2); // e.g., 99.99 seconds
            $table->float('performance', 5, 2); // e.g., 0-100 score
            $table->float('accessibility', 5, 2);
            $table->float('best_practices', 5, 2);
            $table->float('seo', 5, 2);
            $table->integer('nb_backlinks');
            $table->integer('nb_orders');
            $table->integer('nb_cart');
            $table->timestamps();

            $table->foreign('id_projet')->references('id_projet')->on('projets')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};
