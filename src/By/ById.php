<?php

declare(strict_types=1);

namespace Brick\Browser\By;

use Brick\Browser\By;

/**
 * Locates elements by id.
 */
class ById extends By
{
    /**
     * @var string
     */
    private $xPath;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->xPath = sprintf('descendant::*[@id = "%s"]', $id);
    }

    /**
     * {@inheritdoc}
     */
    public function findElements(array $elements) : array
    {
        return By::xPath($this->xPath)->findElements($elements);
    }
}
