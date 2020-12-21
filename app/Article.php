<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //VARS

    protected $table = 'articles';

    protected $fillable = ['title', 'description', 'content', 'category_id', 'image_id', 'user_id'];


    //FUNCTIONS
    
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->where('approved', true);
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'LIKE', "%$title%");
    }
}
