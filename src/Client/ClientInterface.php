<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Exception\ClientException;
use BluePsyduck\FactorioModPortalClient\Request\RequestInterface;
use GuzzleHttp\Promise\PromiseInterface;

/**
 * The interface of the client.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface ClientInterface
{
    /**
     * Sends the request to the API server.
     * @param RequestInterface $request
     * @return PromiseInterface
     * @throws ClientException
     */
    public function sendRequest(RequestInterface $request): PromiseInterface;
}
