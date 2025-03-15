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
        Schema::table('rapports', function (Blueprint $table) {
            // Check if the foreign key exists
            if (!Schema::hasColumn('rapports', 'projet_id')) {
                // Add the foreign key constraint if it doesn't exist
                $table->foreign('projet_id')
                    ->references('id')
                    ->on('projets')
                    ->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('rapports', function (Blueprint $table) {
            // Drop the foreign key if exists
            $table->dropForeign(['projet_id']);
            $table->dropColumn('projet_id');
        });
    }
};
