<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Client\ClientInterface;
use BluePsyduck\FactorioModPortalClient\Client\Facade;
use BluePsyduck\FactorioModPortalClient\Exception\ClientException;
use BluePsyduck\FactorioModPortalClient\Request\FullModRequest;
use BluePsyduck\FactorioModPortalClient\Request\ModListRequest;
use BluePsyduck\FactorioModPortalClient\Request\ModRequest;
use BluePsyduck\FactorioModPortalClient\Response\ModListResponse;
use BluePsyduck\FactorioModPortalClient\Response\ModResponse;
use BluePsyduck\TestHelper\ReflectionTrait;
use GuzzleHttp\Promise\PromiseInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the Facade class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Client\Facade
 */
class FacadeTest extends TestCase
{
    use ReflectionTrait;

    /**
     * The mocked client.
     * @var ClientInterface&MockObject
     */
    protected $client;

    /**
     * Sets up the test case.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = $this->createMock(ClientInterface::class);
    }

    /**
     * Tests the constructing.
     * @throws ReflectionException
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $facade = new Facade($this->client);

        $this->assertSame($this->client, $this->extractProperty($facade, 'client'));
    }

    /**
     * Tests the getMod method.
     * @throws ClientException
     * @covers ::getMod
     */
    public function testGetMod(): void
    {
        /* @var ModRequest&MockObject $request */
        $request = $this->createMock(ModRequest::class);
        /* @var ModResponse&MockObject $response */
        $response = $this->createMock(ModResponse::class);

        /* @var PromiseInterface&MockObject $promise */
        $promise = $this->createMock(PromiseInterface::class);
        $promise->expects($this->once())
                ->method('wait')
                ->willReturn($response);

        $this->client->expects($this->once())
                     ->method('sendRequest')
                     ->with($this->identicalTo($request))
                     ->willReturn($promise);

        $facade = new Facade($this->client);
        $result = $facade->getMod($request);

        $this->assertSame($response, $result);
    }

    /**
     * Tests the getFullMod method.
     * @throws ClientException
     * @covers ::getFullMod
     */
    public function testGetFullMod(): void
    {
        /* @var FullModRequest&MockObject $request */
        $request = $this->createMock(FullModRequest::class);
        /* @var ModResponse&MockObject $response */
        $response = $this->createMock(ModResponse::class);

        /* @var PromiseInterface&MockObject $promise */
        $promise = $this->createMock(PromiseInterface::class);
        $promise->expects($this->once())
                ->method('wait')
                ->willReturn($response);

        $this->client->expects($this->once())
                     ->method('sendRequest')
                     ->with($this->identicalTo($request))
                     ->willReturn($promise);

        $facade = new Facade($this->client);
        $result = $facade->getFullMod($request);

        $this->assertSame($response, $result);
    }

    /**
     * Tests the getModList method.
     * @throws ClientException
     * @covers ::getModList
     */
    public function testGetModList(): void
    {
        /* @var ModListRequest&MockObject $request */
        $request = $this->createMock(ModListRequest::class);
        /* @var ModListResponse&MockObject $response */
        $response = $this->createMock(ModListResponse::class);

        /* @var PromiseInterface&MockObject $promise */
        $promise = $this->createMock(PromiseInterface::class);
        $promise->expects($this->once())
                ->method('wait')
                ->willReturn($response);

        $this->client->expects($this->once())
                     ->method('sendRequest')
                     ->with($this->identicalTo($request))
                     ->willReturn($promise);

        $facade = new Facade($this->client);
        $result = $facade->getModList($request);

        $this->assertSame($response, $result);
    }
}
