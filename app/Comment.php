<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //VARS

    protected $table = 'comments';

    protected $fillable = ['name', 'email', 'content', 'status', 'article_id'];


    //FUNCTIONS
    
    public function article()
    {
    	return $this->belongsTo('App\Article');
    }

    public function scopeSearch($query, $content)
    {
        return $query->where('content', 'LIKE', "%$content%");
    }
}
