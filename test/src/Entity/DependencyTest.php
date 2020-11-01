<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Constant\DependencyOperator;
use BluePsyduck\FactorioModPortalClient\Constant\DependencyType;
use BluePsyduck\FactorioModPortalClient\Entity\Dependency;
use BluePsyduck\FactorioModPortalClient\Entity\Version;
use BluePsyduck\TestHelper\ReflectionTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the Dependency class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Entity\Dependency
 */
class DependencyTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Provides the data for the construct test.
     * @return array<mixed>
     */
    public function provideConstruct(): array
    {
        // phpcs:disable Generic.Files.LineLength
        return [
            ['abc', DependencyType::MANDATORY, 'abc', DependencyOperator::ANY, null],
            ['abc = 1.0', DependencyType::MANDATORY, 'abc', DependencyOperator::EQUAL, new Version('1.0.0')],
            ['abc > 1.0', DependencyType::MANDATORY, 'abc', DependencyOperator::GREATER_THAN, new Version('1.0.0')],
            ['abc >= 1.0', DependencyType::MANDATORY, 'abc', DependencyOperator::GREATER_THAN_EQUAL, new Version('1.0.0')],
            ['abc < 1.0', DependencyType::MANDATORY, 'abc', DependencyOperator::LESS_THAN, new Version('1.0.0')],
            ['abc <= 1.0', DependencyType::MANDATORY, 'abc', DependencyOperator::LESS_THAN_EQUAL, new Version('1.0.0')],

            ['? abc', DependencyType::OPTIONAL, 'abc', DependencyOperator::ANY, null],
            ['? abc = 1.0', DependencyType::OPTIONAL, 'abc', DependencyOperator::EQUAL, new Version('1.0.0')],
            ['? abc > 1.0', DependencyType::OPTIONAL, 'abc', DependencyOperator::GREATER_THAN, new Version('1.0.0')],
            ['? abc >= 1.0', DependencyType::OPTIONAL, 'abc', DependencyOperator::GREATER_THAN_EQUAL, new Version('1.0.0')],
            ['? abc < 1.0', DependencyType::OPTIONAL, 'abc', DependencyOperator::LESS_THAN, new Version('1.0.0')],
            ['? abc <= 1.0', DependencyType::OPTIONAL, 'abc', DependencyOperator::LESS_THAN_EQUAL, new Version('1.0.0')],

            ['(?) abc', DependencyType::OPTIONAL_HIDDEN, 'abc', DependencyOperator::ANY, null],
            ['(?) abc = 1.0', DependencyType::OPTIONAL_HIDDEN, 'abc', DependencyOperator::EQUAL, new Version('1.0.0')],
            ['(?) abc > 1.0', DependencyType::OPTIONAL_HIDDEN, 'abc', DependencyOperator::GREATER_THAN, new Version('1.0.0')],
            ['(?) abc >= 1.0', DependencyType::OPTIONAL_HIDDEN, 'abc', DependencyOperator::GREATER_THAN_EQUAL, new Version('1.0.0')],
            ['(?) abc < 1.0', DependencyType::OPTIONAL_HIDDEN, 'abc', DependencyOperator::LESS_THAN, new Version('1.0.0')],
            ['(?) abc <= 1.0', DependencyType::OPTIONAL_HIDDEN, 'abc', DependencyOperator::LESS_THAN_EQUAL, new Version('1.0.0')],

            ['! abc', DependencyType::CONFLICT, 'abc', DependencyOperator::ANY, null],
            ['! abc = 1.0', DependencyType::CONFLICT, 'abc', DependencyOperator::EQUAL, new Version('1.0.0')],
            ['! abc > 1.0', DependencyType::CONFLICT, 'abc', DependencyOperator::GREATER_THAN, new Version('1.0.0')],
            ['! abc >= 1.0', DependencyType::CONFLICT, 'abc', DependencyOperator::GREATER_THAN_EQUAL, new Version('1.0.0')],
            ['! abc < 1.0', DependencyType::CONFLICT, 'abc', DependencyOperator::LESS_THAN, new Version('1.0.0')],
            ['! abc <= 1.0', DependencyType::CONFLICT, 'abc', DependencyOperator::LESS_THAN_EQUAL, new Version('1.0.0')],

            // Optional spaces
            ['abc>1.0', DependencyType::MANDATORY, 'abc', DependencyOperator::GREATER_THAN, new Version('1.0.0')],
            ['?abc>=1.0', DependencyType::OPTIONAL, 'abc', DependencyOperator::GREATER_THAN_EQUAL, new Version('1.0.0')],
            ['(?)abc<1.0', DependencyType::OPTIONAL_HIDDEN, 'abc', DependencyOperator::LESS_THAN, new Version('1.0.0')],
            ['!abc<=1.0', DependencyType::CONFLICT, 'abc', DependencyOperator::LESS_THAN_EQUAL, new Version('1.0.0')],

            // More complex mod names
            ['abc-def > 1.0.0', DependencyType::MANDATORY, 'abc-def', DependencyOperator::GREATER_THAN, new Version('1.0.0')],
            ['abc_def > 1.0.0', DependencyType::MANDATORY, 'abc_def', DependencyOperator::GREATER_THAN, new Version('1.0.0')],
            ['Abc Def > 1.0.0', DependencyType::MANDATORY, 'Abc Def', DependencyOperator::GREATER_THAN, new Version('1.0.0')],
        ];
        // phpcs:enable Generic.Files.LineLength
    }

    /**
     * Tests the construct method.
     * @param string $dependency
     * @param string $expectedType
     * @param string $expectedMod
     * @param string $expectedOperator
     * @param Version|null $expectedVersion
     * @covers ::__construct
     * @covers ::getType
     * @covers ::getMod
     * @covers ::getOperator
     * @covers ::getVersion
     * @dataProvider provideConstruct
     */
    public function testConstruct(
        string $dependency,
        string $expectedType,
        string $expectedMod,
        string $expectedOperator,
        ?Version $expectedVersion
    ): void {
        $entity = new Dependency($dependency);

        $this->assertSame($expectedType, $entity->getType());
        $this->assertSame($expectedMod, $entity->getMod());
        $this->assertSame($expectedOperator, $entity->getOperator());
        $this->assertEquals($expectedVersion, $entity->getVersion());
    }

    /**
     * Provides the data for the isMatchedByVersion test.
     * @return array<mixed>
     */
    public function provideIsMatchedByVersion(): array
    {
        return [
            ['base', '1.2.3', true],

            ['base > 1.2.3', '2.0.0', true],
            ['base > 1.2.3', '1.3.0', true],
            ['base > 1.2.3', '1.2.4', true],
            ['base > 1.2.3', '1.2.3', false],
            ['base > 1.2.3', '1.2.0', false],
            ['base > 1.2.3', '1.1.0', false],
            ['base > 1.2.3', '0.18.0', false],

            ['base >= 1.2.3', '2.0.0', true],
            ['base >= 1.2.3', '1.3.0', true],
            ['base >= 1.2.3', '1.2.4', true],
            ['base >= 1.2.3', '1.2.3', true],
            ['base >= 1.2.3', '1.2.0', false],
            ['base >= 1.2.3', '1.1.0', false],
            ['base >= 1.2.3', '0.18.0', false],

            ['base = 1.2.3', '2.0.0', false],
            ['base = 1.2.3', '1.3.0', false],
            ['base = 1.2.3', '1.2.4', false],
            ['base = 1.2.3', '1.2.3', true],
            ['base = 1.2.3', '1.2.0', false],
            ['base = 1.2.3', '1.1.0', false],
            ['base = 1.2.3', '0.18.0', false],

            ['base <= 1.2.3', '2.0.0', false],
            ['base <= 1.2.3', '1.3.0', false],
            ['base <= 1.2.3', '1.2.4', false],
            ['base <= 1.2.3', '1.2.3', true],
            ['base <= 1.2.3', '1.2.0', true],
            ['base <= 1.2.3', '1.1.0', true],
            ['base <= 1.2.3', '0.18.0', true],

            ['base < 1.2.3', '2.0.0', false],
            ['base < 1.2.3', '1.3.0', false],
            ['base < 1.2.3', '1.2.4', false],
            ['base < 1.2.3', '1.2.3', false],
            ['base < 1.2.3', '1.2.0', true],
            ['base < 1.2.3', '1.1.0', true],
            ['base < 1.2.3', '0.18.0', true],
        ];
    }

    /**
     * Tests the isMatchedByVersion method.
     * @param string $dependency
     * @param string $version
     * @param bool $expectedResult
     * @covers ::isMatchedByVersion
     * @dataProvider provideIsMatchedByVersion
     */
    public function testIsMatchedByVersion(string $dependency, string $version, bool $expectedResult): void
    {
        $entity = new Dependency($dependency);
        $result = $entity->isMatchedByVersion(new Version($version));

        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the isMatchedByVersion method.
     * @throws ReflectionException
     * @covers ::isMatchedByVersion
     */
    public function testIsMatchedByVersionWithImpossibleDefaultCase(): void
    {
        $entity = new Dependency('abc > 1.2.3');
        $this->injectProperty($entity, 'operator', '');

        $result = $entity->isMatchedByVersion(new Version('4.5.6'));

        $this->assertTrue($result);
    }

    /**
     * Provides the data for the __toString test.
     * @return array<mixed>
     */
    public function provideToString(): array
    {
        return [
            ['abc', 'abc'],
            ['? abc = 1.0', '? abc = 1.0.0'],
            ['(?) abc > 1.0', '(?) abc > 1.0.0'],
            ['! abc >= 1.0', '! abc >= 1.0.0'],
            ['? abc < 1.0', '? abc < 1.0.0'],
            ['! abc <= 1.0', '! abc <= 1.0.0'],

            // Optional spaces will be added
            ['abc>1.0', 'abc > 1.0.0'],
            ['?abc>=1.0', '? abc >= 1.0.0'],
            ['(?)abc<1.0', '(?) abc < 1.0.0'],
            ['!abc<=1.0', '! abc <= 1.0.0'],
        ];
    }

    /**
     * Tests the __toString method.
     * @param string $dependencyString
     * @param string $expectedResult
     * @covers ::__toString
     * @dataProvider provideToString
     */
    public function testToString(string $dependencyString, string $expectedResult): void
    {
        $dependency = new Dependency($dependencyString);
        $result = (string) $dependency;

        $this->assertSame($expectedResult, $result);
    }
}
