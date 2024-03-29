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
use GuzzleHttp\Exception\TransferException;
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
            'base_uri' => rtrim($options->getApiUrl(), '/') . '/',
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
            function (TransferException $exception): void {
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
        return new Request('GET', ltrim($endpoint->getRequestPath($request), '/'));
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

        /** @var class-string<ResponseInterface> $responseClass */
        $responseClass = $endpoint->getResponseClass();

        try {
            /** @var ResponseInterface $result */
            $result = $this->serializer->deserialize($responseContents, $responseClass, 'json');
        } catch (Exception $e) {
            $requestContents = $this->getContentsFromMessage($clientRequest);
            throw new InvalidResponseException($e->getMessage(), $requestContents, $responseContents, $e);
        }

        return $result;
    }

    /**
     * Processes the exception thrown by the HTTP client.
     * @param TransferException $exception
     * @throws ClientException
     */
    protected function processException(TransferException $exception): void
    {
        if ($exception instanceof ConnectException) {
            throw new ConnectionException(
                $exception->getMessage(),
                $this->getContentsFromMessage($exception->getRequest()),
                $exception
            );
        }

        if ($exception instanceof RequestException) {
            throw new ErrorResponseException(
                $this->getErrorMessageFromException($exception),
                $this->getStatusCodeFromException($exception),
                $this->getContentsFromMessage($exception->getRequest()),
                $this->getContentsFromMessage($exception->getResponse()),
                $exception
            );
        }

        throw new ErrorResponseException(
            $exception->getMessage(),
            intval($exception->getCode()),
            '',
            '',
            $exception
        );
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

            /** @var ErrorResponse $errorResponse */
            $errorResponse = $this->serializer->deserialize($responseContents, ErrorResponse::class, 'json');
            $result = $errorResponse->getMessage();
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

    /**
     * Returns the full download URL to a mod release.
     * @param string $downloadPath
     * @return string
     */
    public function getDownloadUrl(string $downloadPath): string
    {
        $result = sprintf($this->options->getDownloadUrlTemplate(), $downloadPath);
        if ($this->options->getUsername() !== '' && $this->options->getToken() !== '') {
            $result .= '?' . http_build_query([
                'username' => $this->options->getUsername(),
                'token' => $this->options->getToken(),
            ]);
        }
        return $result;
    }

    /**
     * Returns the full asset URL to e.g. a thumbnail.
     * @param string $assetPath
     * @return string
     */
    public function getAssetUrl(string $assetPath): string
    {
        return sprintf($this->options->getAssetUrlTemplate(), $assetPath);
    }
}
