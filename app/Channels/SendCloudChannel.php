<?php
/**
 * @link http://www.kyrieup.com/
 * @package SendCloudChannel.php
 * @author kyrie
 * @date: 2017/3/26 下午3:11
 */

namespace App\Channel;

use Illuminate\Notifications\Notification;

class SendCloudChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSendCloud($notifiable);
    }
}