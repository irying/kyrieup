<?php

namespace Acme\Email;

interface Emailer {
    public function send($to, $from, $subject, $message);
}