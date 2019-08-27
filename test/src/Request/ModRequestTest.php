<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Request;

use BluePsyduck\FactorioModPortalClient\Request\ModRequest;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ModRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Request\ModRequest
 */
class ModRequestTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $request = new ModRequest();

        $this->assertSame('', $request->getName());
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $request = new ModRequest();

        $this->assertSame($request, $request->setName($name));
        $this->assertSame($name, $request->getName());
    }
}
