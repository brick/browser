<?php

namespace Brick\Browser\Tests;

use Brick\Browser\Browser;
use Brick\Browser\By;
use Brick\Browser\Client\Client;
use Brick\Browser\Tests\Mock\ApplicationMock;

use PHPUnit\Framework\TestCase;

class BrowserTest extends TestCase
{
    /**
     * @param int     $status
     * @param Browser $browser
     *
     * @return void
     */
    private function assertStatus(int $status, Browser $browser) : void
    {
        $this->assertSame($status, $browser->getLastResponse()->getStatusCode());
    }

    /**
     * @param string  $contents
     * @param Browser $browser
     *
     * @return void
     */
    private function assertContents(string $contents, Browser $browser) : void
    {
        $this->assertStringContainsString($contents, (string) $browser->getLastResponse()->getBody());
    }

    /**
     * @param string   $url
     * @param Browser $browser
     *
     * @return void
     */
    private function assertUrl(string $url, Browser $browser) : void
    {
        $this->assertSame($url, $browser->getUrl());
    }

    /**
     * @return void
     */
    public function testBrowser() : void
    {
        $application = new ApplicationMock();
        $browser = new Browser(new Client($application));

        $browser->open('http://example.com/');

        $this->assertUrl('http://example.com/', $browser);
        $this->assertStatus(200, $browser);
        $this->assertContents('App index', $browser);

        $browser->click(By::linkText('menu'));

        $this->assertUrl('http://example.com/menu', $browser);
        $this->assertStatus(200, $browser);
        $this->assertContents('Menu', $browser);

        $browser->click(By::cssSelector('#user-link a'));

        $this->assertUrl('http://example.com/user/', $browser);
        $this->assertStatus(200, $browser);
        $this->assertContents('User index', $browser);

        $browser->click(By::linkText('profile'));

        $this->assertUrl('http://example.com/user/profile', $browser);
        $this->assertStatus(200, $browser);
        $this->assertContents('User profile', $browser);

        $browser->click(By::linkText('menu'));

        $this->assertUrl('http://example.com/menu', $browser);
        $this->assertStatus(200, $browser);
        $this->assertContents('Menu', $browser);

        $browser->open('http://example.com/not/found');

        $this->assertUrl('http://example.com/not/found', $browser);
        $this->assertStatus(404, $browser);
        $this->assertContents('The requested path was not found', $browser);
    }
}
