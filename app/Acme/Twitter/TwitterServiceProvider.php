<?php

namespace Acme\Twitter;

use Guzzle\Plugin\Oauth\OauthPlugin;
use Guzzle\Service\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class TwitterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('twitter', function () {
            $client = new Client('https://api.twitter.com/1.1');
            $auth = OauthPlugin([
                'consumer_key' => Config::get('twitter.consumer_key'),
                // ...
            ]);
            $client->addSubscriber($auth);

            return new TwitterAPi($client);
        });
    }
}