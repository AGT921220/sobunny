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
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedInteger('eye_color_id')->nullable();
            $table->foreign('eye_color_id')
                ->references('id')
                ->on('eye_colors')
                ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listing', function (Blueprint $table) {
            $table->dropForeign(['eye_color_id']);
            $table->dropColumn('eye_color_id');
        });
    }
};
