<?php

declare(strict_types=1);

namespace Brick\Browser\By;

use Brick\Browser\By;

/**
 * Locates anchor elements by the exact text they display.
 */
class ByLinkText extends By
{
    /**
     * @var string
     */
    private $xPath;

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->xPath = sprintf('descendant::a[normalize-space(.) = "%s"]', $text);
    }

    /**
     * {@inheritdoc}
     */
    public function findElements(array $elements) : array
    {
        return By::xPath($this->xPath)->findElements($elements);
    }
}
