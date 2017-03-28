<?php

/**
 * @link http://www.kyrieup.com/
 * @package StringUtilTest.php
 * @author kyrie
 * @date: 2017/3/28 上午8:00
 */
class StringUtilTest extends \PHPUnit\Framework\TestCase
{
    protected $stringUtil;

    public function setUp()
    {
        $this->stringUtil = new \Kyrie\Hammer\StringUtil();
    }

    public function testStringUtilIsMail()
    {
        $email = 'hello@world.com';
        $emailChecked = $this->stringUtil->isEmail($email);
        $this->assertTrue($emailChecked);
    }

    public function testStringUtilHash()
    {
        $password = $this->stringUtil->hash('md5', 'password', 'kyrie');
        $passwordHash = md5('passwordkyrie');
        $this->assertEquals($password, $passwordHash);
    }
}