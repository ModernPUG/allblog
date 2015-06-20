<?php

class ArticleControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->clearDatabase();
        $this->app->bind('App\IReader', 'App\Reader');
    }

    public function testIndex()
    {
        $this->action('GET', 'ArticleController@index');
        $this->assertViewHas('articles');
        $this->assertViewHas('blogs');
        $this->assertViewMissing('blog');
    }
}
