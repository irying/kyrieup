<?php
/**
 * @link http://www.kyrieup.com/
 * @package UserInterface.php
 * @author kyrie
 * @date: 2017/3/19 下午5:08
 */

namespace Impl\Repo\User;


interface UserInterface
{
    public function register(array $data);

    public function login();
}