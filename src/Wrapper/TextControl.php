<?php

declare(strict_types=1);

namespace Brick\Browser\Wrapper;

use Brick\Browser\Element;
use Brick\Browser\Exception\UnexpectedElementException;

/**
 * Base class for TextInput and TextArea.
 */
abstract class TextControl extends FormControl
{
    /**
     * @param Element $element
     *
     * @return TextControl
     *
     * @throws UnexpectedElementException
     */
    public static function create(Element $element) : TextControl
    {
        switch (strtolower($element->getTagName())) {
            case 'input':
                switch (strtolower($element->getAttribute('type'))) {
                    case 'text':
                    case 'password':
                    case 'hidden':
                    case 'email':
                    case 'number':
                    case 'search':
                    case 'tel':
                    case 'url':
                        return new TextInput($element);
                }
                break;

            case 'textarea':
                return new TextArea($element);
        }

        throw new UnexpectedElementException();
    }

    /**
     * Reads the contents of the text control.
     *
     * @return string
     */
    abstract public function getValue() : string;

    /**
     * Writes some text in the text control.
     *
     * @param string $text
     *
     * @return void
     */
    abstract public function setValue(string $text) : void;

    /**
     * Clears the text control.
     *
     * @return void
     */
    public function clear() : void
    {
        $this->setValue('');
    }
}
