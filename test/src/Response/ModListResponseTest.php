<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Response;

use BluePsyduck\FactorioModPortalClient\Entity\Mod;
use BluePsyduck\FactorioModPortalClient\Entity\Pagination;
use BluePsyduck\FactorioModPortalClient\Response\ModListResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ModListResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Response\ModListResponse
 */
class ModListResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $response = new ModListResponse();

        $this->assertSame([], $response->getResults());

        // Asserted through type-hinting
        $response->getPagination();
    }

    /**
     * Tests the setting and getting the pagination.
     * @covers ::getPagination
     * @covers ::setPagination
     */
    public function testSetAndGetPagination(): void
    {
        $pagination = new Pagination();
        $response = new ModListResponse();

        $this->assertSame($response, $response->setPagination($pagination));
        $this->assertSame($pagination, $response->getPagination());
    }

    /**
     * Tests the setting and getting the results.
     * @covers ::getResults
     * @covers ::setResults
     */
    public function testSetAndGetResults(): void
    {
        $results = [new Mod(), new Mod()];
        $response = new ModListResponse();

        $this->assertSame($response, $response->setResults($results));
        $this->assertSame($results, $response->getResults());
    }
}
