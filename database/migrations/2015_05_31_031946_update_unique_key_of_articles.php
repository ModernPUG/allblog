<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUniqueKeyOfArticles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('articles', function($table)
        {
            $table->dropUnique('articles_link');
            $table->unique(['blog_id', 'link']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('articles', function($table)
        {
            $table->dropUnique(['blog_id', 'link']);
            $table->unique('articles_link');
        });
	}

}
