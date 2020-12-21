<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //VARS

    protected $table = 'documents';

    protected $fillable = ['name', 'original_name', 'title', 'category', 'image_id', 'user_id'];


    //FUNCTIONS

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'LIKE', "%$title%");
    }
}
