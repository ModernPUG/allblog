<?php

//use Feed;

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$this->markTestIncomplete();
		$url = 'http://lesstif.com/spaces/createrssfeed.action?types=page&spaces=laravelphp&maxResults=15&title=[Laravel+%EA%B3%BC+PHP]+Pages+Feed&amp;publicFeed=false&amp;os_authType=basic';

		$rss = Feed::loadAtom($url);

		//dd($rss);

		foreach($rss->entry as $r) {
			dump($r->title);
		}
	}

	public function testQ() 
	{
		$url = 'http://ani2life.com/wp/??feed=rss&cat=8';

		$rss = Feed::loadRss($url);

		dd($rss);

		foreach($rss->entry as $r) {
			dump($r->title);
		}
	}
}
