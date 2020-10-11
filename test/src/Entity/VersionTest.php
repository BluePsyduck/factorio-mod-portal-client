<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\Version;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Version class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Entity\Version
 */
class VersionTest extends TestCase
{
    /**
     * Provides the data for the construct test.
     * @return array<mixed>
     */
    public function provideConstruct(): array
    {
        return [
            ['1.2.3', 1, 2, 3, '1.2.3'],
            ['0.1.2', 0, 1, 2, '0.1.2'],
            ['13.37', 13, 37, 0, '13.37.0'],
            ['42', 42, 0, 0, '42.0.0'],
        ];
    }

    /**
     * Tests the construct method.
     * @param string $version
     * @param int $expectedMajor
     * @param int $expectedMinor
     * @param int $expectedPatch
     * @param string $expectedString
     * @covers ::__construct
     * @covers ::__toString
     * @covers ::getMajor
     * @covers ::getMinor
     * @covers ::getPatch
     * @dataProvider provideConstruct
     */
    public function testConstruct(
        string $version,
        int $expectedMajor,
        int $expectedMinor,
        int $expectedPatch,
        string $expectedString
    ): void {
        $entity = new Version($version);

        $this->assertSame($expectedMajor, $entity->getMajor());
        $this->assertSame($expectedMinor, $entity->getMinor());
        $this->assertSame($expectedPatch, $entity->getPatch());
        $this->assertSame($expectedString, (string) $entity);
    }

    /**
     * Provides the data for the compareTo test.
     * @return array<mixed>
     */
    public function provideCompareTo(): array
    {
        return [
            ['1.2.3', '2.3.4', -1],
            ['1.2.3', '1.2.3', 0],
            ['1.2.3', '0.1.2', 1],
            ['1.2.3', '1.2.4', -1],
            ['1.2.3', '1.2.2', 1],
        ];
    }

    /**
     * Tests the compareTo method.
     * @param string $version1
     * @param string $version2
     * @param int $expectedResult
     * @covers ::compareTo
     * @dataProvider provideCompareTo
     */
    public function testCompareTo(string $version1, string $version2, int $expectedResult): void
    {
        $entity = new Version($version1);
        $result = $entity->compareTo(new Version($version2));

        $this->assertSame($expectedResult, $result);
    }

    /**
     * Provides the data for the isCompatibleTo test.
     * @return array<mixed>
     */
    public function provideIsCompatibleTo(): array
    {
        return [
            ['1.2.3', '1.2.3', true],
            ['1.2.3', '1.2.4', true],
            ['1.2.3', '1.2.2', true],
            ['1.2.3', '1.3.3', false],
            ['1.2.3', '1.1.3', false],

            ['1.0.2', '0.18.36', true],
            ['1.1.0', '0.18.36', false],
            ['0.18.36', '1.0.2', true],
            ['0.17.0', '1.0.0', false],
        ];
    }

    /**
     * Tests the isCompatibleTo method.
     * @param string $version1
     * @param string $version2
     * @param bool $expectedResult
     * @covers ::isCompatibleTo
     * @dataProvider provideIsCompatibleTo
     */
    public function testIsCompatibleTo(string $version1, string $version2, bool $expectedResult): void
    {
        $entity = new Version($version1);
        $result = $entity->isCompatibleTo(new Version($version2));

        $this->assertSame($expectedResult, $result);
    }
}
