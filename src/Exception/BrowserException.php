<?php

declare(strict_types=1);

namespace Brick\Browser\Exception;

/**
 * Exception thrown by the browser.
 */
class BrowserException extends \RuntimeException
{
    /**
     * @return BrowserException
     */
    public static function noDocumentLoaded() : BrowserException
    {
        return new self('No document has been loaded.');
    }
}
