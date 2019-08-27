<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Request;

use BluePsyduck\FactorioModPortalClient\Request\FullModRequest;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the FullModRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Request\FullModRequest
 */
class FullModRequestTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $request = new FullModRequest();

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
        $request = new FullModRequest();

        $this->assertSame($request, $request->setName($name));
        $this->assertSame($name, $request->getName());
    }
}
