<?php
/**
 * @link http://www.kyrieup.com/
 * @package EloquentUser.php
 * @author kyrie
 * @date: 2017/3/19 下午5:10
 */

namespace Impl\Repo\User;


use App\Events\UserRegistered;
use App\User;


class EloquentUser implements UserInterface
{
    /**
     * @var User
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $data
     * @return User
     */
    public function register(array $data)
    {
        $user = $this->user->create($data);
        event(new UserRegistered($user));

        return $user;
    }

    public function login()
    {
        // TODO: Implement login() method.
    }

    /**
     * @param $id
     * @return User
     */
    public function byId($id)
    {
        return $this->user->find($id);
    }
}