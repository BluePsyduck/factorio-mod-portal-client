<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Entity;

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
        return [
            ['abc', Dependency::TYPE_MANDATORY, 'abc', Dependency::OPERATOR_ANY, null],
            ['abc = 1.0', Dependency::TYPE_MANDATORY, 'abc', Dependency::OPERATOR_EQ, new Version('1.0.0')],
            ['abc > 1.0', Dependency::TYPE_MANDATORY, 'abc', Dependency::OPERATOR_GT, new Version('1.0.0')],
            ['abc >= 1.0', Dependency::TYPE_MANDATORY, 'abc', Dependency::OPERATOR_GTE, new Version('1.0.0')],
            ['abc < 1.0', Dependency::TYPE_MANDATORY, 'abc', Dependency::OPERATOR_LT, new Version('1.0.0')],
            ['abc <= 1.0', Dependency::TYPE_MANDATORY, 'abc', Dependency::OPERATOR_LTE, new Version('1.0.0')],

            ['? abc', Dependency::TYPE_OPTIONAL, 'abc', Dependency::OPERATOR_ANY, null],
            ['? abc = 1.0', Dependency::TYPE_OPTIONAL, 'abc', Dependency::OPERATOR_EQ, new Version('1.0.0')],
            ['? abc > 1.0', Dependency::TYPE_OPTIONAL, 'abc', Dependency::OPERATOR_GT, new Version('1.0.0')],
            ['? abc >= 1.0', Dependency::TYPE_OPTIONAL, 'abc', Dependency::OPERATOR_GTE, new Version('1.0.0')],
            ['? abc < 1.0', Dependency::TYPE_OPTIONAL, 'abc', Dependency::OPERATOR_LT, new Version('1.0.0')],
            ['? abc <= 1.0', Dependency::TYPE_OPTIONAL, 'abc', Dependency::OPERATOR_LTE, new Version('1.0.0')],

            ['(?) abc', Dependency::TYPE_OPTIONAL_HIDDEN, 'abc', Dependency::OPERATOR_ANY, null],
            ['(?) abc = 1.0', Dependency::TYPE_OPTIONAL_HIDDEN, 'abc', Dependency::OPERATOR_EQ, new Version('1.0.0')],
            ['(?) abc > 1.0', Dependency::TYPE_OPTIONAL_HIDDEN, 'abc', Dependency::OPERATOR_GT, new Version('1.0.0')],
            ['(?) abc >= 1.0', Dependency::TYPE_OPTIONAL_HIDDEN, 'abc', Dependency::OPERATOR_GTE, new Version('1.0.0')],
            ['(?) abc < 1.0', Dependency::TYPE_OPTIONAL_HIDDEN, 'abc', Dependency::OPERATOR_LT, new Version('1.0.0')],
            ['(?) abc <= 1.0', Dependency::TYPE_OPTIONAL_HIDDEN, 'abc', Dependency::OPERATOR_LTE, new Version('1.0.0')],

            ['! abc', Dependency::TYPE_INCOMPATIBLE, 'abc', Dependency::OPERATOR_ANY, null],
            ['! abc = 1.0', Dependency::TYPE_INCOMPATIBLE, 'abc', Dependency::OPERATOR_EQ, new Version('1.0.0')],
            ['! abc > 1.0', Dependency::TYPE_INCOMPATIBLE, 'abc', Dependency::OPERATOR_GT, new Version('1.0.0')],
            ['! abc >= 1.0', Dependency::TYPE_INCOMPATIBLE, 'abc', Dependency::OPERATOR_GTE, new Version('1.0.0')],
            ['! abc < 1.0', Dependency::TYPE_INCOMPATIBLE, 'abc', Dependency::OPERATOR_LT, new Version('1.0.0')],
            ['! abc <= 1.0', Dependency::TYPE_INCOMPATIBLE, 'abc', Dependency::OPERATOR_LTE, new Version('1.0.0')],

            // Optional spaces
            ['abc>1.0', Dependency::TYPE_MANDATORY, 'abc', Dependency::OPERATOR_GT, new Version('1.0.0')],
            ['?abc>=1.0', Dependency::TYPE_OPTIONAL, 'abc', Dependency::OPERATOR_GTE, new Version('1.0.0')],
            ['(?)abc<1.0', Dependency::TYPE_OPTIONAL_HIDDEN, 'abc', Dependency::OPERATOR_LT, new Version('1.0.0')],
            ['!abc<=1.0', Dependency::TYPE_INCOMPATIBLE, 'abc', Dependency::OPERATOR_LTE, new Version('1.0.0')],

            // More complex mod names
            ['abc-def > 1.0.0', Dependency::TYPE_MANDATORY, 'abc-def', Dependency::OPERATOR_GT, new Version('1.0.0')],
            ['abc_def > 1.0.0', Dependency::TYPE_MANDATORY, 'abc_def', Dependency::OPERATOR_GT, new Version('1.0.0')],
            ['Abc Def > 1.0.0', Dependency::TYPE_MANDATORY, 'Abc Def', Dependency::OPERATOR_GT, new Version('1.0.0')],
        ];
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
}
