<?php

namespace Brick\Browser\Wrapper;

/**
 * A text input.
 */
class TextInput extends TextControl
{
    /**
     * {@inheritdoc}
     */
    public function getValue() : string
    {
        return $this->element->getAttribute('value');
    }

    /**
     * {@inheritdoc}
     */
    public function setValue(string $text) : void
    {
        $this->element->setAttribute('value', $text);
    }
}
