<?php namespace App\Reader;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function articles()
    {
        return $this->belongsToMany('App\Reader\Article');
    }
}
