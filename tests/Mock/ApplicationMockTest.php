<?php

namespace Brick\Browser\Tests\Mock;

use PHPUnit\Framework\TestCase;

/**
 * Ensures that the application mock works as expected.
 * This is a required foundation for other tests.
 */
class ApplicationMockTest extends TestCase
{
    /**
     * @dataProvider providerGetHtmlFile
     *
     * @param string      $path
     * @param string|null $htmlFile
     *
     * @return void
     */
    public function testGetHtmlFile(string $path, ?string $htmlFile) : void
    {
        $this->assertSame($htmlFile, ApplicationMock::getHtmlFile($path));
    }

    /**
     * @return array
     */
    public function providerGetHtmlFile() : array
    {
        return [
            ['', null],
            ['a', null],
            ['a/', null],
            ['a/b', null],
            ['/', '/index.html'],
            ['//', null],
            ['/a', '/a.html'],
            ['/a/', '/a/index.html'],
            ['/a//', null],
            ['/a/b', '/a/b.html'],
            ['/a/b/', '/a/b/index.html'],
            ['/a/b//', null],
            ['/a/b//c', null],
            ['/a/b/c', '/a/b/c.html'],
            ['/a/b/c/', '/a/b/c/index.html'],
        ];
    }
}
