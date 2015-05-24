<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    protected $fillable = [
        'title', 'link', 'description', 'blog_id'
    ];

}
