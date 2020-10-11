<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\Dependency;
use BluePsyduck\FactorioModPortalClient\Entity\InfoJson;
use BluePsyduck\FactorioModPortalClient\Entity\Version;
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
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $entity = new InfoJson();

        $this->assertSame([], $entity->getDependencies());

        // Asserted through type-hint
        $entity->getFactorioVersion();
    }

    /**
     * Tests the setting and getting the dependencies.
     * @covers ::getDependencies
     * @covers ::setDependencies
     */
    public function testSetAndGetDependencies(): void
    {
        $dependencies = [$this->createMock(Dependency::class), $this->createMock(Dependency::class)];
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
        $factorioVersion = new Version('0.1.2');
        $entity = new InfoJson();

        $this->assertSame($entity, $entity->setFactorioVersion($factorioVersion));
        $this->assertSame($factorioVersion, $entity->getFactorioVersion());
    }
}
