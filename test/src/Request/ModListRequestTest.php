<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Request;

use BluePsyduck\FactorioModPortalClient\Request\ModListRequest;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ModListRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Request\ModListRequest
 */
class ModListRequestTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $request = new ModListRequest();

        $this->assertNull($request->getPage());
        $this->assertNull($request->getPageSize());
        $this->assertSame([], $request->getNameList());
    }

    /**
     * Tests the setting and getting the page.
     * @covers ::getPage
     * @covers ::setPage
     */
    public function testSetAndGetPage(): void
    {
        $page = 42;
        $request = new ModListRequest();

        $this->assertSame($request, $request->setPage($page));
        $this->assertSame($page, $request->getPage());
    }

    /**
     * Tests the setting and getting the page size.
     * @covers ::getPageSize
     * @covers ::setPageSize
     */
    public function testSetAndGetPageSize(): void
    {
        $pageSize = 42;
        $request = new ModListRequest();

        $this->assertSame($request, $request->setPageSize($pageSize));
        $this->assertSame($pageSize, $request->getPageSize());
    }

    /**
     * Tests the setting and getting the name list.
     * @covers ::getNameList
     * @covers ::setNameList
     */
    public function testSetAndGetNameList(): void
    {
        $nameList = ['abc', 'def'];
        $request = new ModListRequest();

        $this->assertSame($request, $request->setNameList($nameList));
        $this->assertSame($nameList, $request->getNameList());
    }
}
