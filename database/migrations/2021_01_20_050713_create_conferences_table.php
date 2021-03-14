<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateConferencesTable.
 */
class CreateConferencesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conferences', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('begin_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->string('subject')->nullable();
            $table->string('status')->default(\App\Models\Conference::STATUS_PENDING);
            $table->text('mini_description')->nullable();
            $table->longText('description')->nullable();
            $table->text('additional_files')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('organization')->nullable();
            $table->string('payment_account')->nullable();
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('conferences');
	}
}
