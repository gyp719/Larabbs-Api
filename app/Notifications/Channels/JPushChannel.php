<?php

namespace App\Notifications\Channels;

use JPush\Client;
use Illuminate\Notifications\Notification;

class JPushChannel
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function send($notifiable, Notification $notification)
    {
        // 本地环境默认不推送
        if (app()->environment('local')) {
            return;
        }

        // 没有 registration_id 的不推送
        if (!$notifiable->registration_id) {
            return;
        }

        $notification->toJPush($notifiable, $this->client->push())->send();
    }
}
