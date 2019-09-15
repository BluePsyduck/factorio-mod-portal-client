<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Client\Client;
use BluePsyduck\FactorioModPortalClient\Client\ClientFactory;
use BluePsyduck\FactorioModPortalClient\Client\Options;
use BluePsyduck\FactorioModPortalClient\Constant\ServiceName;
use BluePsyduck\FactorioModPortalClient\Service\EndpointService;
use Interop\Container\ContainerInterface;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ClientFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Client\ClientFactory
 */
class ClientFactoryTest extends TestCase
{
    /**
     * Tests the invoking.
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        /* @var EndpointService&MockObject $endpointService */
        $endpointService = $this->createMock(EndpointService::class);
        /* @var Options&MockObject $options */
        $options = $this->createMock(Options::class);
        /* @var SerializerInterface&MockObject $serializer */
        $serializer = $this->createMock(SerializerInterface::class);

        $expectedResult = new Client($endpointService, $options, $serializer);

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->exactly(3))
                  ->method('get')
                  ->willReturnMap([
                      [EndpointService::class, $endpointService],
                      [Options::class, $options],
                      [ServiceName::SERIALIZER, $serializer]
                  ]);

        $factory = new ClientFactory();
        $result = $factory($container, ContainerInterface::class);

        $this->assertEquals($expectedResult, $result);
    }
}
