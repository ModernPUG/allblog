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
            $conn = Schema::getConnection();
            $dbSchemaManager = $conn->getDoctrineSchemaManager();
            $doctrineTable = $dbSchemaManager->listTableDetails('articles');

            if($doctrineTable->hasIndex('articles_link')) {
                $table->dropUnique('articles_link');
            }

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
            $conn = Schema::getConnection();
            $dbSchemaManager = $conn->getDoctrineSchemaManager();
            $doctrineTable = $dbSchemaManager->listTableDetails('articles');

            if($doctrineTable->hasIndex('articles_blog_id_link_unique')){
                $table->dropForeign('articles_blog_id_foreign');
                $table->dropUnique(['blog_id', 'link']);
            }

            if($doctrineTable->hasIndex('articles_link_unique') == false){
                Schema::table('articles', function(Blueprint $table)
                {
                    $table->unique('link');
                });
            }
        });
	}

}
