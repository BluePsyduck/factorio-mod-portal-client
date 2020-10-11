<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Serializer\Handler;

use BluePsyduck\FactorioModPortalClient\Entity\Version;
use BluePsyduck\FactorioModPortalClient\Serializer\Handler\VersionHandler;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the VersionHandler class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Serializer\Handler\VersionHandler
 */
class VersionHandlerTest extends TestCase
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
                'type' => 'version',
                'method' => 'deserializeVersion',
            ],
        ];

        $result = VersionHandler::getSubscribingMethods();
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the deserializeVersion method.
     * @covers ::deserializeVersion
     */
    public function testDeserializeVersion(): void
    {
        $data = 'abc';
        $type = ['def'];
        $visitedString = '1.2.3';
        $expectedResult = new Version('1.2.3');

        $visitor = $this->createMock(DeserializationVisitorInterface::class);
        $visitor->expects($this->once())
                ->method('visitString')
                ->with($this->identicalTo($data), $this->identicalTo($type))
                ->willReturn($visitedString);

        $handler = new VersionHandler();

        $result = $handler->deserializeVersion($visitor, $data, $type);

        $this->assertEquals($expectedResult, $result);
    }
}
