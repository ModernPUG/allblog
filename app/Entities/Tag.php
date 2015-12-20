<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Tag extends \ModernPUG\FeedReader\Tag implements Transformable
{
    use TransformableTrait;

    private $phpTags = [
        'php',
        'PHP',
        'php 7',
        'php7',
        'PHP 7',
        'PHP7',
        '언어 - PHP',
        'laravel',
        'Laravel',
        'laravel 4',
        'laravel 5',
        'Laravel 4',
        'Laravel 5',
        '라라벨',
        '코드이그나이터',
        'modern php',
        'Modern php',
        'modern PHP',
        'Modern PHP',
        'ModernPHP',
        'wordpress',
        'Wordpress',
        'codeigniter',
        'Codeigniter',
    ];

    public function isPhpTag($tag)
    {
        return in_array($tag, $this->phpTags);
    }

    public function getPhpTags()
    {
        return $this->phpTags;
    }
}
