<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Serializer\Handler;

use BluePsyduck\FactorioModPortalClient\Serializer\Handler\SimpleDateTimeHandler;
use DateTimeImmutable;
use Exception;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the SimpleDateTimeHandler class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Serializer\Handler\SimpleDateTimeHandler
 */
class SimpleDateTimeHandlerTest extends TestCase
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
                'type' => 'simpleDateTime',
                'method' => 'deserializeDateTime',
            ],
        ];

        $result = SimpleDateTimeHandler::getSubscribingMethods();
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the deserializeDateTime method.
     * @covers ::deserializeDateTime
     * @throws Exception
     */
    public function testDeserializeDateTime(): void
    {
        $data = 'abc';
        $type = ['def'];
        $visitedString = '2038-01-19T03:04:17.123456Z';
        $expectedResult = new DateTimeImmutable('2038-01-19T03:04:17.123456Z');

        /* @var DeserializationVisitorInterface&MockObject $visitor */
        $visitor = $this->createMock(DeserializationVisitorInterface::class);
        $visitor->expects($this->once())
                ->method('visitString')
                ->with($this->identicalTo($data), $this->identicalTo($type))
                ->willReturn($visitedString);

        $handler = new SimpleDateTimeHandler();

        $result = $handler->deserializeDateTime($visitor, $data, $type);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the deserializeDateTime method.
     * @covers ::deserializeDateTime
     * @throws Exception
     */
    public function testDeserializeDateTimeWithNull(): void
    {
        $data = null;
        $type = ['def'];

        /* @var DeserializationVisitorInterface&MockObject $visitor */
        $visitor = $this->createMock(DeserializationVisitorInterface::class);
        $visitor->expects($this->never())
                ->method('visitString');

        $handler = new SimpleDateTimeHandler();

        $result = $handler->deserializeDateTime($visitor, $data, $type);

        $this->assertNull($result);
    }
}
