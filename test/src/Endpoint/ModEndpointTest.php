<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Endpoint;

use BluePsyduck\FactorioModPortalClient\Endpoint\ModEndpoint;
use BluePsyduck\FactorioModPortalClient\Request\ModRequest;
use BluePsyduck\FactorioModPortalClient\Response\ModResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ModEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Endpoint\ModEndpoint
 */
class ModEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $expectedResult = ModRequest::class;

        $endpoint = new ModEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $request = new ModRequest();
        $request->setName('abc');
        $expectedResult = '/mods/abc';

        $endpoint = new ModEndpoint();
        $result = $endpoint->getRequestPath($request);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $expectedResult = ModResponse::class;

        $endpoint = new ModEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame($expectedResult, $result);
    }
}
