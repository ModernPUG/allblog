<?php

namespace App\Reader;

interface IReader
{
    public function getLastError();
    public function getCreateViewName();
    public function recentUpdatedArticles();
    public function blogs();
    public function insertFeed($args);
    public function updateAllblogs();
    public function updateBlog($blog);
}