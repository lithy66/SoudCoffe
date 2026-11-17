<?php

namespace App\Services;

use App\Notifications\SystemNotification;
use Illuminate\Support\Collection;

class NotificationService
{
    public static function send(
        $recipients,
        string $type,
        string $titleKey,
        string $bodyKey,
        array $bodyParams = [],
        ?string $url = null,
        array $extra = []
    ): void {
        $notification = new SystemNotification($type, $titleKey, $bodyKey, $bodyParams, $url, $extra);

        if ($recipients instanceof Collection || is_array($recipients)) {
            foreach ($recipients as $recipient) {
                $recipient->notify($notification);
            }
            return;
        }

        $recipients->notify($notification);
    }
}
