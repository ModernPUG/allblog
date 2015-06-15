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
        $links = Reader::findFeedLinks('http://www.planet-php.net');

        $this->assertTrue(isset($links->rdf));
        $this->assertTrue(isset($links->rss));
        $this->assertTrue(isset($links->atom));
    }
}
