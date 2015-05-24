<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleUrlUnique extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('blogs', function($table)
        {
            $table->unique('title');
            $table->unique('url');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('blogs', function($table)
        {
            $table->dropUnique('title');
            $table->dropUnique('url');
        });
	}

}
