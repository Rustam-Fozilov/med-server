<?php

namespace App\Http\Telegraph;

use DefStudio\Telegraph\Handlers\WebhookHandler;

class StartHandler extends WebhookHandler
{
    public function start(): void
    {
        $this->chat->html('Salom 👋')->send();
    }
}
