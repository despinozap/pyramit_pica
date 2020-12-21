<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //VARS

    protected $table = 'categories';

    protected $fillable = ['name'];


    //FUNCTIONS
    
    public function articles()
    {
    	return $this->hasMany('App\Article');
    }

    public function scopeSearchCategory($query, $name)
    {
    	return $query->where('name', '=', $name);
    }
}
