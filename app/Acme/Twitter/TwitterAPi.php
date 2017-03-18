<?php

namespace Acme\Twitter;


use Guzzle\Service\Client;

class TwitterAPi
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search()
    {
        
    }
}