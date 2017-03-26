<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Impl\Repo\User\EloquentUser;

class FollowersController extends Controller
{
    /**
     * @var EloquentUser
     */
    protected $user;

    public function __construct(EloquentUser $user)
    {
        $this->user = $user;
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $user = $this->user->byId($id);
        $followers = $user->followersUser()->pluck('follower_id')->toArray();
        if (in_array(\Auth::guard('api')->user()->id, $followers)) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow()
    {
        $userToFollow = $user = $this->user->byId(request('user'));
        $followed = \Auth::guard('api')->user()->followThisUser($userToFollow->id);
        if (count($followed['attached']) > 0) {
            $userToFollow->increment('followers_count');
            return response()->json(['followed' => true]);
        } else {
            $userToFollow->decrement('followers_count');
            return response()->json(['followed' => false]);
        }
    }
}
