<?php

class ArticleControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->clearDatabase();
        $this->app->bind('Koojunho\Reader\IReader', 'Koojunho\Reader\Reader');
    }

    public function testIndex()
    {
        $this->action('GET', 'ArticleController@index');
        $this->assertViewHas('articles');
        $this->assertViewHas('blogs');
        $this->assertViewMissing('blog');
    }
}
