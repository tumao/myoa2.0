<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuCatelogue extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//创建menu_catelogue表
		Schema::create('menu_catelogue',function($table)
		{
			$table->increments('id',true)->unique();
			$table->string('name',50);
			$table->string('icon',50)->nullable();
			$table->integer('root');
			$table->integer('group');
			$table->integer('sort');
			$table->string('path',100);
			// $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//删除menu_catelogue
		Schema::drop('menu_catelogue');
	}

}
