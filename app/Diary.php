<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'user_id'
    ];
}
