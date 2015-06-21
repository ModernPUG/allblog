<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropBlogTypeField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('blogs', function ($table) {
            $table->dropColumn('type');
        });
        Schema::table('users', function ($table) {
            $table->dropColumn('is_admin');
        });
        Schema::drop('blog_models');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
