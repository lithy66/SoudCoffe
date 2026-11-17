<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SystemNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $type, string $titleKey, string $bodyKey, array $bodyParams = [], ?string $url = null, array $extra = [])
    {
        $this->type = $type;
        $this->titleKey = $titleKey;
        $this->bodyKey = $bodyKey;
        $this->bodyParams = $bodyParams;
        $this->url = $url;
        $this->extra = $extra;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable): array
    {
        return [
            'type'        => $this->type,
            'title_key'   => $this->titleKey,
            'body_key'    => $this->bodyKey,
            'body_params' => $this->bodyParams,
            'url'         => $this->url,
            'extra'       => $this->extra,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
