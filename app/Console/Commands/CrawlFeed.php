<?php namespace App\Console\Commands;

use App\Article;
use App\Blog;
use Feed;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Wandu\Http\Uri;

class CrawlFeed extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crawlfeed:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RSS를 긁어온다.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $blogs = Blog::all();
        foreach ($blogs as $blog) {
            $url = $blog->url;

            if ($blog->atom == true)
            {
                $this->crawlAtom($url, $blog);
                continue;
            }
            $rss = Feed::loadRss($url);

            foreach ($rss->item as $item) {
                $uri = new Uri($item->link);
                $link = $uri->getPath() .'?'. $uri->getQuery();
                try {
                    Article::firstOrCreate([
                        'title' => $item->title,
                        'link' => $link,
                        'description' => $item->description,
                        'blog_id' => $blog->id
                    ]);
                } catch (\PDOException $e) {
                    if ($e->getCode() != 23000) {
                        echo $e->getCode().PHP_EOL;
                    }
                }
            }


        }
    }

    /**
     * atom feed 가져오기
     */ 
    private function crawlAtom($url, $blog)
    {
        $feeds = Feed::loadAtom($url);

        foreach ($feeds->entry as $feed) {

            $link = $feed->link->attributes()->{'href'};
            
            try {
                Article::firstOrCreate([
                    'title' => $feed->title,
                    'link' => $link,
                    'description' => $feed->summary,
                    'blog_id' => $blog->id
                ]);
            } catch (Exception $e) {
                \Log::error($e);
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

}
