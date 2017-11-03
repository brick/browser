<?php

declare(strict_types=1);

namespace Brick\Browser\Exception;

class NoSuchElementException extends BrowserException
{
    /**
     * @return NoSuchElementException
     */
    public static function emptyList() : NoSuchElementException
    {
        return new self('The element list is empty.');
    }

    /**
     * @param int $index
     *
     * @return NoSuchElementException
     */
    public static function undefinedIndex(int $index) : NoSuchElementException
    {
        return new self(sprintf('Element with index "%s" does not exist', $index));
    }
}
