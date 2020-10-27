<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\Links;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Links class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Entity\Links
 */
class LinksTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $entity = new Links();

        $this->assertNull($entity->getFirst());
        $this->assertNull($entity->getPrev());
        $this->assertNull($entity->getNext());
        $this->assertNull($entity->getLast());
    }

    /**
     * Tests the setting and getting the first.
     * @covers ::getFirst
     * @covers ::setFirst
     */
    public function testSetAndGetFirst(): void
    {
        $first = 'abc';
        $entity = new Links();

        $this->assertSame($entity, $entity->setFirst($first));
        $this->assertSame($first, $entity->getFirst());
    }

    /**
     * Tests the setting and getting the prev.
     * @covers ::getPrev
     * @covers ::setPrev
     */
    public function testSetAndGetPrev(): void
    {
        $prev = 'abc';
        $entity = new Links();

        $this->assertSame($entity, $entity->setPrev($prev));
        $this->assertSame($prev, $entity->getPrev());
    }

    /**
     * Tests the setting and getting the next.
     * @covers ::getNext
     * @covers ::setNext
     */
    public function testSetAndGetNext(): void
    {
        $next = 'abc';
        $entity = new Links();

        $this->assertSame($entity, $entity->setNext($next));
        $this->assertSame($next, $entity->getNext());
    }

    /**
     * Tests the setting and getting the last.
     * @covers ::getLast
     * @covers ::setLast
     */
    public function testSetAndGetLast(): void
    {
        $last = 'abc';
        $entity = new Links();

        $this->assertSame($entity, $entity->setLast($last));
        $this->assertSame($last, $entity->getLast());
    }
}
