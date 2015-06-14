<?php

class ArticleControllerTest extends TestCase {

    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
    }
    
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
