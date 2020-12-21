<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //VARS

    protected $table = 'albums';

    protected $fillable = ['title', 'description', 'image_id', 'user_id'];


    //FUNCTIONS

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
