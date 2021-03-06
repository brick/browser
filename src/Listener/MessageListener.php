<?php

declare(strict_types=1);

namespace Brick\Browser\Listener;

use Brick\Http\Message;

interface MessageListener
{
    /**
     * This method is called whenever a Request is sent or a Response is received.
     *
     * @param Message $message
     *
     * @return void
     */
    public function listen(Message $message) : void;
}
