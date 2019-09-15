<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Client\Client;
use BluePsyduck\FactorioModPortalClient\Client\Options;
use BluePsyduck\FactorioModPortalClient\Endpoint\EndpointInterface;
use BluePsyduck\FactorioModPortalClient\Exception\ClientException;
use BluePsyduck\FactorioModPortalClient\Exception\ConnectionException;
use BluePsyduck\FactorioModPortalClient\Exception\ErrorResponseException;
use BluePsyduck\FactorioModPortalClient\Exception\InvalidResponseException;
use BluePsyduck\FactorioModPortalClient\Request\RequestInterface;
use BluePsyduck\FactorioModPortalClient\Response\ErrorResponse;
use BluePsyduck\FactorioModPortalClient\Response\ResponseInterface;
use BluePsyduck\FactorioModPortalClient\Service\EndpointService;
use BluePsyduck\TestHelper\ReflectionTrait;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\MessageInterface as PsrMessageInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\StreamInterface;
use ReflectionException;

/**
 * The PHPUnit test of the Client class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Client\Client
 */
class ClientTest extends TestCase
{
    use ReflectionTrait;

    /**
     * The mocked endpoint service.
     * @var EndpointService&MockObject
     */
    protected $endpointService;

    /**
     * The mocked options.
     * @var Options&MockObject
     */
    protected $options;

    /**
     * The mocked serializer.
     * @var SerializerInterface&MockObject
     */
    protected $serializer;

    /**
     * The mocked guzzle client.
     * @var GuzzleClient&MockObject
     */
    protected $guzzleClient;

    /**
     * Sets up the test case.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->endpointService = $this->createMock(EndpointService::class);
        $this->options = $this->createMock(Options::class);
        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->guzzleClient = $this->createMock(GuzzleClient::class);
    }

    /**
     * Creates and returns a mocked client.
     * @param array $methods
     * @return Client|MockObject
     */
    protected function createMockedClient(array $methods): Client
    {
        $methods[] = 'createGuzzleClient';

        /* @var Client&MockObject $client */
        $client = $this->getMockBuilder(Client::class)
                       ->setMethods($methods)
                       ->disableOriginalConstructor()
                       ->getMock();
        $client->expects($this->once())
               ->method('createGuzzleClient')
               ->willReturn($this->guzzleClient);

        $client->__construct($this->endpointService, $this->options, $this->serializer);
        return $client;
    }

    /**
     * Tests the constructing.
     * @throws ReflectionException
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $client = $this->createMockedClient([]);

        $this->assertSame($this->endpointService, $this->extractProperty($client, 'endpointService'));
        $this->assertSame($this->options, $this->extractProperty($client, 'options'));
        $this->assertSame($this->serializer, $this->extractProperty($client, 'serializer'));
        $this->assertSame($this->guzzleClient, $this->extractProperty($client, 'guzzleClient'));
    }

    /**
     * Tests the createGuzzleClient method.
     * @throws ReflectionException
     * @covers ::createGuzzleClient
     */
    public function testCreateGuzzleClient(): void
    {
        $apiUrl = 'https://www.example.com/';
        $timeout = 42;

        /* @var Options&MockObject $options */
        $options = $this->createMock(Options::class);
        $options->expects($this->once())
                ->method('getApiUrl')
                ->willReturn($apiUrl);
        $options->expects($this->once())
                ->method('getTimeout')
                ->willReturn($timeout);

        $client = new Client($this->endpointService, $this->options, $this->serializer);

        /* @var GuzzleClient $result */
        $result = $this->invokeMethod($client, 'createGuzzleClient', $options);

        $this->assertSame($apiUrl, (string) $result->getConfig('base_uri'));
        $this->assertSame($timeout, $result->getConfig('timeout'));
    }

    /**
     * Tests the sendRequest method.
     * @throws ClientException
     * @covers ::sendRequest
     */
    public function testSendRequest(): void
    {
        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);
        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);
        /* @var ResponseInterface&MockObject $response */
        $response = $this->createMock(ResponseInterface::class);
        /* @var RequestException&MockObject $requestException */
        $requestException = $this->createMock(RequestException::class);

        /* @var PromiseInterface&MockObject $promise2 */
        $promise2 = $this->createMock(PromiseInterface::class);

        /* @var PromiseInterface&MockObject $promise1 */
        $promise1 = $this->createMock(PromiseInterface::class);
        $promise1->expects($this->once())
                 ->method('then')
                 ->with(
                     $this->callback(function ($callback) use ($clientResponse, $response) {
                         $this->assertIsCallable($callback);

                         $result = $callback($clientResponse);
                         $this->assertSame($response, $result);

                         return true;
                     }),
                     $this->callback(function ($callback) use ($requestException) {
                         $this->assertIsCallable($callback);

                         $callback($requestException);

                         return true;
                     })
                 )
                 ->willReturn($promise2);

        $this->guzzleClient->expects($this->once())
                           ->method('sendAsync')
                           ->with($this->identicalTo($clientRequest))
                           ->willReturn($promise1);

        $client = $this->createMockedClient(['createClientRequest', 'processResponse', 'processException']);
        $client->expects($this->once())
               ->method('createClientRequest')
               ->with($this->identicalTo($request))
               ->willReturn($clientRequest);
        $client->expects($this->once())
               ->method('processResponse')
               ->with(
                   $this->identicalTo($request),
                   $this->identicalTo($clientRequest),
                   $this->identicalTo($clientResponse)
               )
               ->willReturn($response);
        $client->expects($this->once())
               ->method('processException')
               ->with($this->identicalTo($requestException));

        $result = $client->sendRequest($request);

        $this->assertSame($promise2, $result);
    }

    /**
     * Tests the createClientRequest method.
     * @throws ReflectionException
     * @covers ::createClientRequest
     */
    public function testCreateClientRequest(): void
    {
        $requestPath = '/abc';
        $expectedResult = new Request('GET', 'abc');

        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);

        /* @var EndpointInterface&MockObject $endpoint */
        $endpoint = $this->createMock(EndpointInterface::class);
        $endpoint->expects($this->once())
                 ->method('getRequestPath')
                 ->with($this->identicalTo($request))
                 ->willReturn($requestPath);

        $this->endpointService->expects($this->once())
                              ->method('getEndpointForRequest')
                              ->with($this->identicalTo($request))
                              ->willReturn($endpoint);

        $client = $this->createMockedClient([]);
        $result = $this->invokeMethod($client, 'createClientRequest', $request);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the processResponse method.
     * @throws ReflectionException
     * @covers ::processResponse
     */
    public function testProcessResponse(): void
    {
        $responseClass = 'abc';
        $responseContents = 'def';

        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);
        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);
        /* @var ResponseInterface&MockObject $response */
        $response = $this->createMock(ResponseInterface::class);

        /* @var EndpointInterface&MockObject $endpoint */
        $endpoint = $this->createMock(EndpointInterface::class);
        $endpoint->expects($this->once())
                 ->method('getResponseClass')
                 ->willReturn($responseClass);

        $this->endpointService->expects($this->once())
                              ->method('getEndpointForRequest')
                              ->with($this->identicalTo($request))
                              ->willReturn($endpoint);
        
        $this->serializer->expects($this->once())
                         ->method('deserialize')
                         ->with(
                             $this->identicalTo($responseContents),
                             $this->identicalTo($responseClass),
                             $this->identicalTo('json')
                         )
                         ->willReturn($response);

        $client = $this->createMockedClient(['getContentsFromMessage']);
        $client->expects($this->once())
               ->method('getContentsFromMessage')
               ->with($this->identicalTo($clientResponse))
               ->willReturn($responseContents);

        $result = $this->invokeMethod($client, 'processResponse', $request, $clientRequest, $clientResponse);

        $this->assertSame($response, $result);
    }

    /**
     * Tests the processResponse method.
     * @throws ReflectionException
     * @covers ::processResponse
     */
    public function testProcessResponseWithException(): void
    {
        $responseClass = 'abc';
        $requestContents = 'def';
        $responseContents = 'ghi';

        $exception = new Exception('foo');

        /* @var RequestInterface&MockObject $request */
        $request = $this->createMock(RequestInterface::class);
        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);
        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);

        /* @var EndpointInterface&MockObject $endpoint */
        $endpoint = $this->createMock(EndpointInterface::class);
        $endpoint->expects($this->once())
                 ->method('getResponseClass')
                 ->willReturn($responseClass);

        $this->endpointService->expects($this->once())
                              ->method('getEndpointForRequest')
                              ->with($this->identicalTo($request))
                              ->willReturn($endpoint);

        $this->serializer->expects($this->once())
                         ->method('deserialize')
                         ->with(
                             $this->identicalTo($responseContents),
                             $this->identicalTo($responseClass),
                             $this->identicalTo('json')
                         )
                         ->willThrowException($exception);

        $client = $this->createMockedClient(['getContentsFromMessage']);
        $client->expects($this->exactly(2))
               ->method('getContentsFromMessage')
               ->withConsecutive(
                   [$this->identicalTo($clientResponse)],
                   [$this->identicalTo($clientRequest)]
               )
               ->willReturnOnConsecutiveCalls(
                   $responseContents,
                   $requestContents
               );


        $this->expectException(InvalidResponseException::class);

        $this->invokeMethod($client, 'processResponse', $request, $clientRequest, $clientResponse);
    }

    /**
     * Tests the processException method.
     * @throws ReflectionException
     * @covers ::processException
     */
    public function testProcessException(): void
    {
        $message = 'abc';
        $statusCode = 42;
        $requestContents = 'def';
        $responseContents = 'ghi';

        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);
        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);

        $exception = new RequestException('foo', $clientRequest, $clientResponse);
        $expectedException = new ErrorResponseException(
            $message,
            $statusCode,
            $requestContents,
            $responseContents,
            $exception
        );

        $client = $this->createMockedClient([
            'getErrorMessageFromException',
            'getStatusCodeFromException',
            'getContentsFromMessage'
        ]);
        $client->expects($this->once())
               ->method('getErrorMessageFromException')
               ->with($this->identicalTo($exception))
               ->willReturn($message);
        $client->expects($this->once())
               ->method('getStatusCodeFromException')
               ->with($this->identicalTo($exception))
               ->willReturn($statusCode);
        $client->expects($this->exactly(2))
               ->method('getContentsFromMessage')
               ->withConsecutive(
                   [$this->identicalTo($clientRequest)],
                   [$this->identicalTo($clientResponse)]
               )
               ->willReturnOnConsecutiveCalls(
                   $requestContents,
                   $responseContents
               );

        $this->expectExceptionObject($expectedException);

        $this->invokeMethod($client, 'processException', $exception);
    }

    /**
     * Tests the processException method.
     * @throws ReflectionException
     * @covers ::processException
     */
    public function testProcessExceptionWithConnectException(): void
    {
        $message = 'abc';
        $requestContents = 'def';

        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);

        $exception = new ConnectException($message, $clientRequest);
        $expectedException = new ConnectionException($message, $requestContents, $exception);

        $client = $this->createMockedClient(['getContentsFromMessage']);
        $client->expects($this->once())
               ->method('getContentsFromMessage')
               ->with($this->identicalTo($clientRequest))
               ->willReturn($requestContents);

        $this->expectExceptionObject($expectedException);

        $this->invokeMethod($client, 'processException', $exception);
    }

    /**
     * Tests the getStatusCodeFromException method.
     * @throws ReflectionException
     * @covers ::getStatusCodeFromException
     */
    public function testGetStatusCodeFromException(): void
    {
        $statusCode = 42;

        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);

        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);
        $clientResponse->expects($this->atLeastOnce())
                       ->method('getStatusCode')
                       ->willReturn($statusCode);

        $requestException = new RequestException('foo', $clientRequest, $clientResponse);
        $client = $this->createMockedClient([]);

        $result = $this->invokeMethod($client, 'getStatusCodeFromException', $requestException);

        $this->assertSame($statusCode, $result);
    }

    /**
     * Tests the getStatusCodeFromException method.
     * @throws ReflectionException
     * @covers ::getStatusCodeFromException
     */
    public function testGetStatusCodeFromExceptionWithoutResponse(): void
    {
        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);

        $requestException = new RequestException('foo', $clientRequest);
        $client = $this->createMockedClient([]);

        $result = $this->invokeMethod($client, 'getStatusCodeFromException', $requestException);

        $this->assertSame(0, $result);
    }

    /**
     * Tests the getErrorMessageFromException method.
     * @throws ReflectionException
     * @covers ::getErrorMessageFromException
     */
    public function testGetErrorMessageFromException(): void
    {
        $exceptionMessage = 'abc';
        $responseContents = 'def';
        $errorMessage = 'ghi';

        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);
        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);

        $requestException = new RequestException($exceptionMessage, $clientRequest, $clientResponse);

        /* @var ErrorResponse&MockObject $response */
        $response = $this->createMock(ErrorResponse::class);
        $response->expects($this->once())
                 ->method('getMessage')
                 ->willReturn($errorMessage);

        $this->serializer->expects($this->once())
                         ->method('deserialize')
                         ->with(
                             $this->identicalTo($responseContents),
                             $this->identicalTo(ErrorResponse::class),
                             $this->identicalTo('json')
                         )
                         ->willReturn($response);

        $client = $this->createMockedClient(['getContentsFromMessage']);
        $client->expects($this->once())
               ->method('getContentsFromMessage')
               ->with($this->identicalTo($clientResponse))
               ->willReturn($responseContents);

        $result = $this->invokeMethod($client, 'getErrorMessageFromException', $requestException);

        $this->assertSame($errorMessage, $result);
    }

    /**
     * Tests the getErrorMessageFromException method.
     * @throws ReflectionException
     * @covers ::getErrorMessageFromException
     */
    public function testGetErrorMessageFromExceptionWithException(): void
    {
        $exceptionMessage = 'abc';
        $responseContents = 'def';

        /* @var PsrRequestInterface&MockObject $clientRequest */
        $clientRequest = $this->createMock(PsrRequestInterface::class);
        /* @var PsrResponseInterface&MockObject $clientResponse */
        $clientResponse = $this->createMock(PsrResponseInterface::class);

        $requestException = new RequestException($exceptionMessage, $clientRequest, $clientResponse);

        $this->serializer->expects($this->once())
                         ->method('deserialize')
                         ->with(
                             $this->identicalTo($responseContents),
                             $this->identicalTo(ErrorResponse::class),
                             $this->identicalTo('json')
                         )
                         ->willThrowException($this->createMock(Exception::class));

        $client = $this->createMockedClient(['getContentsFromMessage']);
        $client->expects($this->once())
               ->method('getContentsFromMessage')
               ->with($this->identicalTo($clientResponse))
               ->willReturn($responseContents);

        $result = $this->invokeMethod($client, 'getErrorMessageFromException', $requestException);

        $this->assertSame($exceptionMessage, $result);
    }

    /**
     * Tests the getContentsFromMessage method.
     * @throws ReflectionException
     * @covers ::getContentsFromMessage
     */
    public function testGetContentsFromMessage(): void
    {
        $contents = 'abc';

        /* @var StreamInterface&MockObject $stream */
        $stream = $this->createMock(StreamInterface::class);
        $stream->expects($this->once())
               ->method('getContents')
               ->willReturn($contents);

        /* @var PsrMessageInterface&MockObject $message */
        $message = $this->createMock(PsrMessageInterface::class);
        $message->expects($this->once())
                ->method('getBody')
                ->willReturn($stream);

        $client = $this->createMockedClient([]);
        $result = $this->invokeMethod($client, 'getContentsFromMessage', $message);

        $this->assertSame($contents, $result);
    }

    /**
     * Tests the getContentsFromMessage method without an actual message instance.
     * @throws ReflectionException
     * @covers ::getContentsFromMessage
     */
    public function testGetContentsFromMessageWithoutMessage(): void
    {
        $message = null;
        $expectedResult = '';

        $client = $this->createMockedClient([]);
        $result = $this->invokeMethod($client, 'getContentsFromMessage', $message);

        $this->assertSame($expectedResult, $result);
    }
}
