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
            $table->unsignedBigInteger('second_city_id')->nullable();
            $table->foreign('second_city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('set null');

            $table->unsignedBigInteger('third_city_id')->nullable();
            $table->foreign('third_city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['second_city_id']);
            $table->dropColumn('second_city_id');
            $table->dropForeign(['third_city_id']);
            $table->dropColumn('third_city_id');
        });
    }
};
