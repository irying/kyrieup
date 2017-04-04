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

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }

    // owner: one-to-many
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // follow: many-to-many
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_diary')->withTimestamps();
    }

    public function scopeEnabled($query)
    {
        return $query->where('status', 'enabled');
    }
}
