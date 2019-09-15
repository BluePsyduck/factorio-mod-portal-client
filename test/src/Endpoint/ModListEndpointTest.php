<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Endpoint;

use BluePsyduck\FactorioModPortalClient\Endpoint\ModListEndpoint;
use BluePsyduck\FactorioModPortalClient\Request\ModListRequest;
use BluePsyduck\FactorioModPortalClient\Response\ModListResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ModListEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Endpoint\ModListEndpoint
 */
class ModListEndpointTest extends TestCase
{
/**
     * Tests the getSupportedRequestClass method.
     * @covers ::getSupportedRequestClass
     */
    public function testGetSupportedRequestClass(): void
    {
        $expectedResult = ModListRequest::class;

        $endpoint = new ModListEndpoint();
        $result = $endpoint->getSupportedRequestClass();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPath(): void
    {
        $request = new ModListRequest();
        $request->setPage(42)
                ->setPageSize(21)
                ->setNameList(['abc', 'def']);
        $expectedResult = '/mods?page=42&page_size=21&namelist=abc%2Cdef';

        $endpoint = new ModListEndpoint();
        $result = $endpoint->getRequestPath($request);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the getRequestPath method.
     * @covers ::getRequestPath
     */
    public function testGetRequestPathWithEmptyRequest(): void
    {
        $request = new ModListRequest();
        $expectedResult = '/mods?';

        $endpoint = new ModListEndpoint();
        $result = $endpoint->getRequestPath($request);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the getResponseClass method.
     * @covers ::getResponseClass
     */
    public function testGetResponseClass(): void
    {
        $expectedResult = ModListResponse::class;

        $endpoint = new ModListEndpoint();
        $result = $endpoint->getResponseClass();

        $this->assertSame($expectedResult, $result);
    }
}
