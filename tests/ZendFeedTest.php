<?php

use Zend\Feed\Reader\Reader;

class ZendFeedTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testFindFeedLinks()
    {
        $links = Reader::findFeedLinks('http://bookworm.pe.kr/wordpress/');

        $this->assertTrue(!isset($links->rdf));
        $this->assertTrue(isset($links->rss));
        $this->assertTrue(!isset($links->atom));
    }
}
