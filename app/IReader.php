<?php

namespace App;

interface IReader
{
    public function getLastError();
    public function recentUpdatedArticles();
    public function blogs();
    public function insertFeed($hostUrl, $feedUrl, $type);
}