<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ModernPUG\FeedReader\Article;
use ModernPUG\FeedReader\ArticleController as ArticleTrait;
use ModernPUG\FeedReader\IReader;
use ModernPUG\FeedReader\Tag;

class ArticleController extends Controller
{
    use ArticleTrait;

    public function index(ArticleRepository $articleRepository, \App\Entities\Tag $tag, Request $request)
    {
        $tagInput = $request->input('tag');

        if($tagInput == null) $tagInput = 'php';

        $tags = [];
        $phpTags = $tag->getPhpTags();

        if($tagInput == 'all') {
            $articles = $articleRepository->recentUpdatedArticles();
        } else {
            if($tagInput == 'php') {
                $tags = $phpTags;
            }

            $articles = $articleRepository->recentUpdatedArticlesByTag($tags);
        }

        if($tagInput) {
            $pagination = $articles->appends(['tag' => $tagInput])->render();
        } else {
            $pagination = $articles->render();
        }

        $data = [
            'articles' => $articles,
            'pagination' => $pagination,
            'tag' => $tagInput,
            'phpTags' => $phpTags
        ];

        return view('allblog.articles', $data);
    }

    public function tagPhp(Article $article, Tag $tag, Request $request)
    {
        $articleId = $request->get('article_id');

        $article = $article->find($articleId);

        $tag = $tag->where('name','PHP')->first();

        try {
            $article->tags()->attach($tag['id']);
        } catch (\RuntimeException $e) {
            Log::info($e->getMessage());
        }
    }
}
