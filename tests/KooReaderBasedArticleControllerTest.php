<?php

class KooReaderBasedArticleControllerTest extends ArticleControllerTest
{
    public function setUp()
    {
        parent::setUp();
        $this->app->bind('App\IReader', 'App\KooReader');
    }
}
