<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Serializer\Construction;

use BluePsyduck\FactorioModPortalClient\Entity\Pagination;
use BluePsyduck\FactorioModPortalClient\Serializer\Construction\ObjectConstructor;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ObjectConstructor class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Serializer\Construction\ObjectConstructor
 */
class ObjectConstructorTest extends TestCase
{
    /**
     * Tests the construct method.
     * @covers ::construct
     */
    public function testConstruct(): void
    {
        $metaData = new ClassMetadata(Pagination::class);
        $expectedResult = new Pagination();

        /* @var DeserializationVisitorInterface&MockObject $visitor */
        $visitor = $this->createMock(DeserializationVisitorInterface::class);
        /* @var DeserializationContext&MockObject $context */
        $context = $this->createMock(DeserializationContext::class);

        $constructor = new ObjectConstructor();
        $result = $constructor->construct($visitor, $metaData, null, [], $context);

        $this->assertEquals($expectedResult, $result);
    }
}
