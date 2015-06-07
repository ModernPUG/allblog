<?php

class ArticleControllerTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$this->action('GET', 'ArticleController@index');
        $this->assertViewHas('articles');
        $this->assertViewHas('blogs');
        $this->assertViewMissing('blog');
	}

}
