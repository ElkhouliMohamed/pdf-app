<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('top_keywords', function (Blueprint $table) {
            $table->integer('nb_clicks')->default(0);  // Add nb_clicks column
            $table->integer('nb_impressions')->default(0);  // Add nb_impressions column
            $table->decimal('avg_ctr', 5, 2)->default(0);  // Add avg_ctr column
            $table->decimal('avg_position', 5, 2)->default(0);
            $table->integer('nombre_requetes')->default(0);  // This will set the default value to 0
            // Add avg_position column
        });
    }

    public function down()
    {
        Schema::table('top_keywords', function (Blueprint $table) {
            $table->dropColumn('nb_clicks');
            $table->dropColumn('nb_impressions');
            $table->dropColumn('avg_ctr');
            $table->dropColumn('avg_position');
            $table->integer('nombre_requetes');  // This will set the default value to 0

        });
    }
};
