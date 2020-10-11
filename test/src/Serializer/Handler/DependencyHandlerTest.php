<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Serializer\Handler;

use BluePsyduck\FactorioModPortalClient\Entity\Dependency;
use BluePsyduck\FactorioModPortalClient\Serializer\Handler\DependencyHandler;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the DependencyHandler class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Serializer\Handler\DependencyHandler
 */
class DependencyHandlerTest extends TestCase
{
    /**
     * Tests the getSubscribingMethods method.
     * @covers ::getSubscribingMethods
     */
    public function testGetSubscribingMethods(): void
    {
        $expectedResult = [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'dependency',
                'method' => 'deserializeDependency',
            ],
        ];

        $result = DependencyHandler::getSubscribingMethods();
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the deserializeDependency method.
     * @covers ::deserializeDependency
     */
    public function testDeserializeDependency(): void
    {
        $data = 'abc';
        $type = ['def'];
        $visitedString = 'ghi';
        $expectedResult = new Dependency('ghi');

        $visitor = $this->createMock(DeserializationVisitorInterface::class);
        $visitor->expects($this->once())
                ->method('visitString')
                ->with($this->identicalTo($data), $this->identicalTo($type))
                ->willReturn($visitedString);

        $handler = new DependencyHandler();

        $result = $handler->deserializeDependency($visitor, $data, $type);

        $this->assertEquals($expectedResult, $result);
    }
}
