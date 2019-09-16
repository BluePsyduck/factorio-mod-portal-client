<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Client\Options;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Options class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Client\Options
 */
class OptionsTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $options = new Options();

        $this->assertSame('', $options->getApiUrl());
        $this->assertSame(0, $options->getTimeout());
        $this->assertSame('', $options->getDownloadUrlTemplate());
        $this->assertSame('', $options->getAssetUrlTemplate());
        $this->assertSame('', $options->getUsername());
        $this->assertSame('', $options->getToken());
    }

    /**
     * Tests the setting and getting the api url.
     * @covers ::getApiUrl
     * @covers ::setApiUrl
     */
    public function testSetAndGetApiUrl(): void
    {
        $apiUrl = 'abc';
        $options = new Options();

        $this->assertSame($options, $options->setApiUrl($apiUrl));
        $this->assertSame($apiUrl, $options->getApiUrl());
    }

    /**
     * Tests the setting and getting the timeout.
     * @covers ::getTimeout
     * @covers ::setTimeout
     */
    public function testSetAndGetTimeout(): void
    {
        $timeout = 42;
        $options = new Options();

        $this->assertSame($options, $options->setTimeout($timeout));
        $this->assertSame($timeout, $options->getTimeout());
    }

    /**
     * Tests the setting and getting the download url template.
     * @covers ::getDownloadUrlTemplate
     * @covers ::setDownloadUrlTemplate
     */
    public function testSetAndGetDownloadUrlTemplate(): void
    {
        $downloadUrlTemplate = 'abc';
        $options = new Options();

        $this->assertSame($options, $options->setDownloadUrlTemplate($downloadUrlTemplate));
        $this->assertSame($downloadUrlTemplate, $options->getDownloadUrlTemplate());
    }

    /**
     * Tests the setting and getting the asset url template.
     * @covers ::getAssetUrlTemplate
     * @covers ::setAssetUrlTemplate
     */
    public function testSetAndGetAssetUrlTemplate(): void
    {
        $assetUrlTemplate = 'abc';
        $options = new Options();

        $this->assertSame($options, $options->setAssetUrlTemplate($assetUrlTemplate));
        $this->assertSame($assetUrlTemplate, $options->getAssetUrlTemplate());
    }

    /**
     * Tests the setting and getting the username.
     * @covers ::getUsername
     * @covers ::setUsername
     */
    public function testSetAndGetUsername(): void
    {
        $username = 'abc';
        $options = new Options();

        $this->assertSame($options, $options->setUsername($username));
        $this->assertSame($username, $options->getUsername());
    }

    /**
     * Tests the setting and getting the token.
     * @covers ::getToken
     * @covers ::setToken
     */
    public function testSetAndGetToken(): void
    {
        $token = 'abc';
        $options = new Options();

        $this->assertSame($options, $options->setToken($token));
        $this->assertSame($token, $options->getToken());
    }
}
