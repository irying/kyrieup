<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'confirmation_token',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @param Model $model
     * @return mixed
     */
    public function owns(Model $model)
    {
        return $this->id == $model->user_id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(Diary::class, 'user_diary')->withTimestamps();
    }

    /**
     * @param $diaryId
     * @return array
     */
    public function followThis($diaryId)
    {
        return $this->follows()->toggle($diaryId);
    }

    /**
     * @param $diaryId
     * @return bool
     */
    public function followed($diaryId)
    {
        return !! $this->follows()->where('diary_id', $diaryId)->count();
    }

    /**
     * 关注列表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(self::class, 'followers', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * 粉丝列表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followersUser()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
    }

    /**
     * 关注xx
     * @param $user
     * @return array
     */
    public function followThisUser($user)
    {
        return $this->following()->toggle($user);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }
}
