<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //VARS

    protected $table = 'photos';

    protected $fillable = ['description', 'image_id', 'album_id'];


    //FUNCTIONS
    
    public function image()
    {
    	return $this->belongsTo('App\Image');
    }

    public function album()
    {
    	return $this->belongsTo('App\Album');
    }
}
