<?php

use Zend\Feed\Reader\Reader;

class KooReaderBasedBlogControllerTest extends BlogControllerTest
{
    public function setUp()
    {
        parent::setUp();
        $this->app->bind('App\IReader', 'App\KooReader');
    }

    public function testFindFeedLinks()
    {
        $links = Reader::findFeedLinks('http://bookworm.pe.kr/wordpress/');
        $this->assertTrue(!isset($links->rdf));
        $this->assertTrue(isset($links->rss));
        $this->assertTrue(!isset($links->atom));
    }
}
