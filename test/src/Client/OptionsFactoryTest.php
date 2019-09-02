<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Client\Options;
use BluePsyduck\FactorioModPortalClient\Client\OptionsFactory;
use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the OptionsFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Client\OptionsFactory
 */
class OptionsFactoryTest extends TestCase
{
    /**
     * Tests the invoking.
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        $config = [
            ConfigKey::MAIN => [
                ConfigKey::OPTIONS => [
                    ConfigKey::OPTION_API_URL => 'abc',
                    ConfigKey::OPTION_TIMEOUT => 42,
                    ConfigKey::OPTION_USERNAME => 'def',
                    ConfigKey::OPTION_TOKEN => 'ghi',
                ],
            ],
        ];

        $expectedResult = new Options();
        $expectedResult->setApiUrl('abc')
                       ->setTimeout(42)
                       ->setUsername('def')
                       ->setToken('ghi');

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        $factory = new OptionsFactory();
        $result = $factory($container, Options::class);

        $this->assertEquals($expectedResult, $result);
    }
}
