<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Endpoint;

use BluePsyduck\FactorioModPortalClient\Endpoint\FullModEndpoint;
use BluePsyduck\FactorioModPortalClient\Request\FullModRequest;
use BluePsyduck\FactorioModPortalClient\Response\ModResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the FullModEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Endpoint\FullModEndpoint
 */
class FullModEndpointTest extends TestCase
{
    /**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $expectedResult = FullModRequest::class;

        $endpoint = new FullModEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $request = new FullModRequest();
        $request->setName('abc');
        $expectedResult = '/mods/abc/full';

        $endpoint = new FullModEndpoint();
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

        $endpoint = new FullModEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame($expectedResult, $result);
    }
}
