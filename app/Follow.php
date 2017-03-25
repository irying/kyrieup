<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'user_diary';

    protected $fillable = ['user_id', 'diary_id'];
}
