<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Serializer;

use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;
use BluePsyduck\FactorioModPortalClient\Serializer\SerializerFactory;
use BluePsyduck\TestHelper\ReflectionTrait;
use Interop\Container\ContainerInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the SerializerFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Serializer\SerializerFactory
 */
class SerializerFactoryTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the invoking.
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        $builder = SerializerBuilder::create();
        $builder->addMetadataDir(
                    (string) realpath(__DIR__ . '/../../../config/serializer'),
                    'BluePsyduck\FactorioModPortalClient'
                );

        $expectedResult = $builder->build();

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);

        /* @var SerializerFactory&MockObject $factory */
        $factory = $this->getMockBuilder(SerializerFactory::class)
                        ->setMethods(['addCacheDirectory'])
                        ->getMock();
        $factory->expects($this->once())
                ->method('addCacheDirectory')
                ->with($this->identicalTo($container));

        $result = $factory($container, SerializerInterface::class);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the addCacheDirectory method.
     * @throws ReflectionException
     * @covers ::addCacheDirectory
     */
    public function testAddCacheDirectory(): void
    {
        $cacheDir = 'test/coverage';
        $config = [
            ConfigKey::MAIN => [
                ConfigKey::CACHE_DIR => $cacheDir,
            ],
        ];

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        $serializerBuilder = new SerializerBuilder();
        $expectedSerializerBuilder = clone $serializerBuilder;
        $expectedSerializerBuilder->setCacheDir($cacheDir);

        $factory = new SerializerFactory();
        $this->invokeMethod($factory, 'addCacheDirectory', $container, $serializerBuilder);

        $this->assertEquals($expectedSerializerBuilder, $serializerBuilder);
    }

    /**
     * Tests the addCacheDirectory method without a proper config value.
     * @throws ReflectionException
     * @covers ::addCacheDirectory
     */
    public function testAddCacheDirectoryWithoutConfig(): void
    {
        $config = [];

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        $serializerBuilder = new SerializerBuilder();
        $expectedSerializerBuilder = clone $serializerBuilder;

        $factory = new SerializerFactory();
        $this->invokeMethod($factory, 'addCacheDirectory', $container, $serializerBuilder);

        $this->assertEquals($expectedSerializerBuilder, $serializerBuilder);
    }
}
