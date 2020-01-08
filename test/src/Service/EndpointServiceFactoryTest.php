<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Service;

use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;
use BluePsyduck\FactorioModPortalClient\Endpoint\EndpointInterface;
use BluePsyduck\FactorioModPortalClient\Service\EndpointService;
use BluePsyduck\FactorioModPortalClient\Service\EndpointServiceFactory;
use BluePsyduck\TestHelper\ReflectionTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use ReflectionException;

/**
 * The PHPUnit test of the EndpointServiceFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Service\EndpointServiceFactory
 */
class EndpointServiceFactoryTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the invoking.
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        $endpointAliases = ['abc', 'def'];
        $config = [
            ConfigKey::MAIN => [
                ConfigKey::ENDPOINTS => $endpointAliases,
            ],
        ];

        /* @var EndpointInterface&MockObject $endpoint1 */
        $endpoint1 = $this->createMock(EndpointInterface::class);
        /* @var EndpointInterface&MockObject $endpoint2 */
        $endpoint2 = $this->createMock(EndpointInterface::class);

        $endpoints = [$endpoint1, $endpoint2];

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        /* @var EndpointServiceFactory&MockObject $factory */
        $factory = $this->getMockBuilder(EndpointServiceFactory::class)
                        ->setMethods(['createEndpoints'])
                        ->getMock();
        $factory->expects($this->once())
                ->method('createEndpoints')
                ->with($this->identicalTo($container), $this->identicalTo($endpointAliases))
                ->willReturn($endpoints);

        $factory($container, EndpointService::class);
    }

    /**
     * Tests the createEndpoints method.
     * @throws ReflectionException
     * @covers ::createEndpoints
     */
    public function testCreateEndpoints(): void
    {
        $aliases = ['abc', 'def'];

        /* @var EndpointInterface&MockObject $endpoint1 */
        $endpoint1 = $this->createMock(EndpointInterface::class);
        /* @var EndpointInterface&MockObject $endpoint2 */
        $endpoint2 = $this->createMock(EndpointInterface::class);

        $expectedResult = [$endpoint1, $endpoint2];

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->exactly(2))
                  ->method('get')
                  ->withConsecutive(
                      [$this->identicalTo('abc')],
                      [$this->identicalTo('def')]
                  )
                  ->willReturnOnConsecutiveCalls(
                      $endpoint1,
                      $endpoint2
                  );

        $factory = new EndpointServiceFactory();
        $result = $this->invokeMethod($factory, 'createEndpoints', $container, $aliases);

        $this->assertEquals($expectedResult, $result);
    }
}
