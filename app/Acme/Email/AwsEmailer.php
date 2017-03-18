<?php
/**
 * Created by PhpStorm.
 * User: kyrie
 * Date: 2017/3/15
 * Time: 下午11:31
 */

namespace Acme\Email;


class AwsEmailer implements Emailer
{

    public function __construct(AwsSDK $aws)
    {
        $this->aws = $aws;
    }
    
    public function send($to, $from, $subject, $message)
    {
        // TODO: Implement send() method.
    }
}