<?php
/**
 * @link http://www.kyrieup.com/
 * @package RepoServiceProvider.php
 * @author kyrie
 * @date: 2017/3/19 下午9:30
 */

namespace Impl\Repo\Diary;


use App\Diary;
use App\User;
use Barryvdh\Cors\ServiceProvider;
use Impl\Repo\User\EloquentUser;

class RepoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $app = $this->app;
        $app->bind('Impl\Repo\Diary\DiaryInterface', function($app){
           return new EloquentDiary(new Diary);
        });
        $app->bind('Impl\Repo\User\UserInterface', function($app){
            return new EloquentUser(new User);
        });
    }
}