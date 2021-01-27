<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'imgURL'
    ];

    // public function setEmailAttribute($value)
    // { 
    //     $this->attributes['title'] = ucfirst($value);
    // }
}
