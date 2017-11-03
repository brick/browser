<?php

namespace Brick\Browser\Wrapper;

/**
 * A text area.
 */
class TextArea extends TextControl
{
    /**
     * {@inheritdoc}
     */
    public function getValue() : string
    {
        return $this->element->getDomElement()->nodeValue;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue(string $text) : void
    {
        $this->element->getDomElement()->nodeValue = $text;
    }
}
