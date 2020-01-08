<?php

declare(strict_types=1);

namespace BluePsyduckTestAsset\FactorioModPortalClient;

use BluePsyduck\FactorioModPortalClient\Serializer\SerializerFactory;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * The test case for testing serializing of data.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SerializerTestCase extends TestCase
{
    /**
     * Asserts that deserializing the data to the object actually equals the object.
     * @param array<mixed> $serializedData
     * @param object $expectedObject
     */
    protected function assertDeserializedObject(array $serializedData, object $expectedObject): void
    {
        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $serializer = (new SerializerFactory())($container, SerializerInterface::class);

        $result = $serializer->deserialize((string) json_encode($serializedData), get_class($expectedObject), 'json');

        $this->assertEquals($expectedObject, $result);
    }
}
