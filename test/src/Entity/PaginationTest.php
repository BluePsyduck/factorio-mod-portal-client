<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\Links;
use BluePsyduck\FactorioModPortalClient\Entity\Pagination;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Pagination class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Entity\Pagination
 */
class PaginationTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $entity = new Pagination();

        $this->assertSame(0, $entity->getCount());
        $this->assertSame(0, $entity->getPage());
        $this->assertSame(0, $entity->getPageCount());
        $this->assertSame(0, $entity->getPageSize());

        // Asserted through type-hinting
        $entity->getLinks();
    }

    /**
     * Tests the setting and getting the count.
     * @covers ::getCount
     * @covers ::setCount
     */
    public function testSetAndGetCount(): void
    {
        $count = 42;
        $entity = new Pagination();

        $this->assertSame($entity, $entity->setCount($count));
        $this->assertSame($count, $entity->getCount());
    }

    /**
     * Tests the setting and getting the page.
     * @covers ::getPage
     * @covers ::setPage
     */
    public function testSetAndGetPage(): void
    {
        $page = 42;
        $entity = new Pagination();

        $this->assertSame($entity, $entity->setPage($page));
        $this->assertSame($page, $entity->getPage());
    }

    /**
     * Tests the setting and getting the page count.
     * @covers ::getPageCount
     * @covers ::setPageCount
     */
    public function testSetAndGetPageCount(): void
    {
        $pageCount = 42;
        $entity = new Pagination();

        $this->assertSame($entity, $entity->setPageCount($pageCount));
        $this->assertSame($pageCount, $entity->getPageCount());
    }

    /**
     * Tests the setting and getting the page size.
     * @covers ::getPageSize
     * @covers ::setPageSize
     */
    public function testSetAndGetPageSize(): void
    {
        $pageSize = 42;
        $entity = new Pagination();

        $this->assertSame($entity, $entity->setPageSize($pageSize));
        $this->assertSame($pageSize, $entity->getPageSize());
    }

    /**
     * Tests the setting and getting the links.
     * @covers ::getLinks
     * @covers ::setLinks
     */
    public function testSetAndGetLinks(): void
    {
        $links = new Links();
        $entity = new Pagination();

        $this->assertSame($entity, $entity->setLinks($links));
        $this->assertSame($links, $entity->getLinks());
    }
}
