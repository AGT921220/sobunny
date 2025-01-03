<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('threads_messages', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('thread_id')->unsigned()->nullable();
			$table->bigInteger('user_id')->unsigned()->nullable();
			$table->mediumtext('body')->nullable();
			$table->string('file_path', 255)->nullable();
			$table->bigInteger('deleted_by')->unsigned()->nullable();
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
			
			$table->index(['thread_id']);
			$table->index(['user_id']);
			$table->index(['created_at']);
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::dropIfExists('threads_messages');
	}
};
