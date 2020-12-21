<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //VARS

    protected $table = 'contacts';

    protected $fillable = ['name', 'subname', 'email', 'phone', 'facebook', 'twitter'];

}
