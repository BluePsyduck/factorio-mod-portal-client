<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\InfoJson;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the InfoJson class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Entity\InfoJson
 */
class InfoJsonTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $entity = new InfoJson();

        $this->assertSame([], $entity->getDependencies());
        $this->assertSame('', $entity->getFactorioVersion());
    }

    /**
     * Tests the setting and getting the dependencies.
     * @covers ::getDependencies
     * @covers ::setDependencies
     */
    public function testSetAndGetDependencies(): void
    {
        $dependencies = ['abc', 'def'];
        $entity = new InfoJson();

        $this->assertSame($entity, $entity->setDependencies($dependencies));
        $this->assertSame($dependencies, $entity->getDependencies());
    }

    /**
     * Tests the setting and getting the factorio version.
     * @covers ::getFactorioVersion
     * @covers ::setFactorioVersion
     */
    public function testSetAndGetFactorioVersion(): void
    {
        $factorioVersion = '0.1.2';
        $entity = new InfoJson();

        $this->assertSame($entity, $entity->setFactorioVersion($factorioVersion));
        $this->assertSame($factorioVersion, $entity->getFactorioVersion());
    }
}
