<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Exception\ClientException;
use BluePsyduck\FactorioModPortalClient\Exception\ConnectionException;
use BluePsyduck\FactorioModPortalClient\Exception\ErrorResponseException;
use BluePsyduck\FactorioModPortalClient\Exception\InvalidResponseException;
use BluePsyduck\FactorioModPortalClient\Request\RequestInterface;
use BluePsyduck\FactorioModPortalClient\Response\ErrorResponse;
use BluePsyduck\FactorioModPortalClient\Response\ResponseInterface;
use BluePsyduck\FactorioModPortalClient\Service\EndpointService;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\MessageInterface as PsrMessageInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * The actual client sending the requests.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Client implements ClientInterface
{
    /**
     * The endpoint service.
     * @var EndpointService
     */
    protected $endpointService;

    /**
     * The options of the client.
     * @var Options
     */
    protected $options;

    /**
     * The serializer.
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * The guzzle client.
     * @var GuzzleClient
     */
    protected $guzzleClient;

    /**
     * Initializes the client.
     * @param EndpointService $endpointService
     * @param Options $options
     * @param SerializerInterface $serializer
     */
    public function __construct(
        EndpointService $endpointService,
        Options $options,
        SerializerInterface $serializer
    ) {
        $this->endpointService = $endpointService;
        $this->options = $options;
        $this->serializer = $serializer;

        $this->guzzleClient = $this->createGuzzleClient($options);
    }

    /**
     * Creates the guzzle client to use to actually send the requests.
     * @param Options $options
     * @return GuzzleClient
     */
    protected function createGuzzleClient(Options $options): GuzzleClient
    {
        return new GuzzleClient([
            'base_uri' => $options->getApiUrl(),
            'timeout' => $options->getTimeout(),
        ]);
    }

    /**
     * Sends the request to the API server.
     * @param RequestInterface $request
     * @return PromiseInterface
     * @throws ClientException
     */
    public function sendRequest(RequestInterface $request): PromiseInterface
    {
        $clientRequest = $this->createClientRequest($request);
        return $this->guzzleClient->sendAsync($clientRequest)->then(
            function (PsrResponseInterface $clientResponse) use ($request, $clientRequest): ResponseInterface {
                return $this->processResponse($request, $clientRequest, $clientResponse);
            },
            function (RequestException $exception): void {
                $this->processException($exception);
            }
        );
    }

    /**
     * Creates the request actually send through the HTTP client.
     * @param RequestInterface $request
     * @return PsrRequestInterface
     * @throws ClientException
     */
    protected function createClientRequest(RequestInterface $request): PsrRequestInterface
    {
        $endpoint = $this->endpointService->getEndpointForRequest($request);
        return new Request('GET', $endpoint->getRequestPath($request));
    }

    /**
     * Processes the response received from the HTTP client.
     * @param RequestInterface $request
     * @param PsrRequestInterface $clientRequest
     * @param PsrResponseInterface $clientResponse
     * @return ResponseInterface
     * @throws ClientException
     */
    protected function processResponse(
        RequestInterface $request,
        PsrRequestInterface $clientRequest,
        PsrResponseInterface $clientResponse
    ): ResponseInterface {
        $endpoint = $this->endpointService->getEndpointForRequest($request);
        $responseContents = $this->getContentsFromMessage($clientResponse);

        try {
            $result = $this->serializer->deserialize($responseContents, $endpoint->getResponseClass(), 'json');
        } catch (Exception $e) {
            $requestContents = $this->getContentsFromMessage($clientRequest);
            throw new InvalidResponseException($e->getMessage(), $requestContents, $responseContents, $e);
        }

        return $result;
    }

    /**
     * Processes the exception thrown by the HTTP client.
     * @param RequestException $exception
     * @throws ClientException
     */
    protected function processException(RequestException $exception): void
    {
        if ($exception instanceof ConnectException) {
            throw new ConnectionException(
                $exception->getMessage(),
                $this->getContentsFromMessage($exception->getRequest()),
                $exception
            );
        } else {
            throw new ErrorResponseException(
                $this->getErrorMessageFromException($exception),
                $this->getStatusCodeFromException($exception),
                $this->getContentsFromMessage($exception->getRequest()),
                $this->getContentsFromMessage($exception->getResponse()),
                $exception
            );
        }
    }

    /**
     * Returns the status code from the exception.
     * @param RequestException $exception
     * @return int
     */
    protected function getStatusCodeFromException(RequestException $exception): int
    {
        $result = 0;
        if ($exception->getResponse() !== null) {
            $result = $exception->getResponse()->getStatusCode();
        }
        return $result;
    }

    /**
     * Returns the error message from the exception.
     * @param RequestException $exception
     * @return string
     */
    protected function getErrorMessageFromException(RequestException $exception): string
    {
        $result = $exception->getMessage();

        try {
            $responseContents = $this->getContentsFromMessage($exception->getResponse());
            $errorResponse = $this->serializer->deserialize($responseContents, ErrorResponse::class, 'json');
            if ($errorResponse instanceof ErrorResponse) {
                $result = $errorResponse->getMessage();
            }
        } catch (Exception $e) {
            // Failed to fetch message from error response.
        }

        return $result;
    }

    /**
     * Returns the contents of the message (i.e. request or response), if it is an actual instance.
     * @param PsrMessageInterface $message
     * @return string
     */
    protected function getContentsFromMessage(?PsrMessageInterface $message): string
    {
        $result = '';
        if ($message !== null) {
            $result = $message->getBody()->getContents();
        }
        return $result;
    }
}
