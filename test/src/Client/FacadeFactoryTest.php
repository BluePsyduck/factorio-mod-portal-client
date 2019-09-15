<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Client\ClientInterface;
use BluePsyduck\FactorioModPortalClient\Client\Facade;
use BluePsyduck\FactorioModPortalClient\Client\FacadeFactory;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the FacadeFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Client\FacadeFactory
 */
class FacadeFactoryTest extends TestCase
{
    /**
     * Tests the invoking.
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        /* @var ClientInterface&MockObject $client */
        $client = $this->createMock(ClientInterface::class);

        $expectedResult = new Facade($client);

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->exactly(1))
                  ->method('get')
                  ->willReturnMap([
                      [ClientInterface::class, $client],
                  ]);

        $factory = new FacadeFactory();
        $result = $factory($container, ContainerInterface::class);

        $this->assertEquals($expectedResult, $result);
    }
}
