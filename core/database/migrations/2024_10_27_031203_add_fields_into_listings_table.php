<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedInteger('gender_id')->nullable();
            $table->foreign('gender_id')
                ->references('id')
                ->on('genders')
                ->onDelete('set null');

            $table->unsignedInteger('ethnicity_id')->nullable();
            $table->foreign('ethnicity_id')
                ->references('id')
                ->on('ethnicities')
                ->onDelete('set null');

            $table->unsignedInteger('age_id')->nullable();
            $table->foreign('age_id')
                ->references('id')
                ->on('ages')
                ->onDelete('set null');

            $table->unsignedInteger('body_type_id')->nullable();
            $table->foreign('body_type_id')
                ->references('id')
                ->on('body_types')
                ->onDelete('set null');

            $table->unsignedInteger('service_type_id')->nullable();
            $table->foreign('service_type_id')
                ->references('id')
                ->on('service_types')
                ->onDelete('set null');

            $table->unsignedInteger('cater_id')->nullable();
            $table->foreign('cater_id')
                ->references('id')
                ->on('caters')
                ->onDelete('set null');

            $table->unsignedInteger('breast_id')->nullable();
            $table->foreign('breast_id')
                ->references('id')
                ->on('breasts')
                ->onDelete('set null');

            $table->unsignedInteger('height_id')->nullable();
            $table->foreign('height_id')
                ->references('id')
                ->on('heights')
                ->onDelete('set null');

            $table->unsignedInteger('hair_color_id')->nullable();
            $table->foreign('hair_color_id')
                ->references('id')
                ->on('hair_colors')
                ->onDelete('set null');

            $table->unsignedInteger('servicing_id')->nullable();
            $table->foreign('servicing_id')
                ->references('id')
                ->on('servicings')
                ->onDelete('set null');
        });
    }


    public function down()
    {
        Schema::table('listing', function (Blueprint $table) {
            $table->dropForeign(['gender_id']);
            $table->dropColumn('gender_id');

            $table->dropForeign(['ethnicity_id']);
            $table->dropColumn('ethnicity_id');

            $table->dropForeign(['age_id']);
            $table->dropColumn('age_id');

            $table->dropForeign(['body_type_id']);
            $table->dropColumn('body_type_id');

            $table->dropForeign(['service_type_id']);
            $table->dropColumn('service_type_id');

            $table->dropForeign(['cater_id']);
            $table->dropColumn('cater_id');

            $table->dropForeign(['breast_id']);
            $table->dropColumn('breast_id');

            $table->dropForeign(['height_id']);
            $table->dropColumn('height_id');

            $table->dropForeign(['hair_color_id']);
            $table->dropColumn('hair_color_id');

            $table->dropForeign(['servicing_id']);
            $table->dropColumn('servicing_id');
        });
    }
};
