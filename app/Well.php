<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Well extends Model
{
    //VARS

    protected $table = 'wells';

    protected $fillable = ['name', 'description', 'author', 'link', 'image_id', 'user_id'];


    //FUNCTIONS

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function image()
    {
        return $this->belongsTo('App\Image');
    }
}
