<?php

declare(strict_types=1);

namespace Brick\Browser\Exception;

class TooManyElementsException extends BrowserException
{
    /**
     * @param int $count
     *
     * @return TooManyElementsException
     */
    public static function expectedOne(int $count) : TooManyElementsException
    {
        return new self(sprintf('Expected 1 element, found %d.', $count));
    }
}
