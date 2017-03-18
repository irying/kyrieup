<?php

namespace Acme\Twitter;


class Facade extends \Illuminate\Support\Facades\Facade
{
    public static function getFacadeAccessor()
    {
        return 'twiiter';
    }
}