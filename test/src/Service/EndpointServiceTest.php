<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Service;

use BluePsyduck\FactorioModPortalClient\Endpoint\EndpointInterface;
use BluePsyduck\FactorioModPortalClient\Exception\UnsupportedRequestException;
use BluePsyduck\FactorioModPortalClient\Request\RequestInterface;
use BluePsyduck\FactorioModPortalClient\Service\EndpointService;
use BluePsyduck\TestHelper\ReflectionTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the EndpointService class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Service\EndpointService
 */
class EndpointServiceTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the constructing.
     * @throws ReflectionException
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        /* @var EndpointInterface&MockObject $endpoint1 */
        $endpoint1 = $this->createMock(EndpointInterface::class);
        $endpoint1->expects($this->once())
                  ->method('getSupportedRequestClass')
                  ->willReturn('abc');

        /* @var EndpointInterface&MockObject $endpoint2 */
        $endpoint2 = $this->createMock(EndpointInterface::class);
        $endpoint2->expects($this->once())
                  ->method('getSupportedRequestClass')
                  ->willReturn('def');

        $endpoints = [$endpoint1, $endpoint2];
        $expectedEndpoints = [
            'abc' => $endpoint1,
            'def' => $endpoint2,
        ];

        $service = new EndpointService($endpoints);

        $this->assertEquals($expectedEndpoints, $this->extractProperty($service, 'endpointsByRequestClass'));
    }

    /**
     * Tests the getEndpointForRequest method.
     * @throws ReflectionException
     * @throws UnsupportedRequestException
     * @covers ::getEndpointForRequest
     */
    public function testGetEndpointForRequest(): void
    {
        /* @var RequestInterface&MockObject $request */
        $request = $this->getMockBuilder(RequestInterface::class)
                        ->setMockClassName('MockedRequestInterface')
                        ->getMockForAbstractClass();

        /* @var EndpointInterface&MockObject $endpoint1 */
        $endpoint1 = $this->createMock(EndpointInterface::class);
        /* @var EndpointInterface&MockObject $endpoint2 */
        $endpoint2 = $this->createMock(EndpointInterface::class);

        $endpoints = [
            'MockedRequestInterface' => $endpoint1,
            'abc' => $endpoint2,
        ];

        $service = new EndpointService([]);
        $this->injectProperty($service, 'endpointsByRequestClass', $endpoints);

        $result = $service->getEndpointForRequest($request);

        $this->assertSame($endpoint1, $result);
    }

    /**
     * Tests the getEndpointForRequest method with throwing an exception.
     * @throws ReflectionException
     * @throws UnsupportedRequestException
     * @covers ::getEndpointForRequest
     */
    public function testGetEndpointForRequestWithException(): void
    {
        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);

        /* @var EndpointInterface&MockObject $endpoint1 */
        $endpoint1 = $this->createMock(EndpointInterface::class);
        /* @var EndpointInterface&MockObject $endpoint2 */
        $endpoint2 = $this->createMock(EndpointInterface::class);

        $endpoints = [
            'abc' => $endpoint1,
            'def' => $endpoint2,
        ];

        $this->expectException(UnsupportedRequestException::class);

        $service = new EndpointService([]);
        $this->injectProperty($service, 'endpointsByRequestClass', $endpoints);

        $service->getEndpointForRequest($request);
    }
}
