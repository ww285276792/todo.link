<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class ResetPasswordNotification
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ResetPasswordNotification extends Notification
{
//    use Queueable;

    public $token;

    /**
     * ResetPasswordNotification constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('重置密码')
            ->view('notification.reset_password', [
                'url' => route('password.reset', $this->token)
            ]);
    }
}
