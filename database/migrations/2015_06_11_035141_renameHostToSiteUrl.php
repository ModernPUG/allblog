<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class renameHostToSiteUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function ($table) {
            $table->renameColumn('url', 'feed_url');
            $table->renameColumn('host', 'site_url');
            $table->string('type', 4)->default('rss');
            $table->dropColumn('atom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function ($table) {
            $table->renameColumn('feed_url', 'url');
            $table->renameColumn('site_url', 'host');
            $table->dropColumn('type');
            $table->boolean('atom');
        });
    }
}
