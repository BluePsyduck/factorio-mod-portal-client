<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Endpoint;

use BluePsyduck\FactorioModPortalClient\Request\FullModRequest;
use BluePsyduck\FactorioModPortalClient\Request\RequestInterface;
use BluePsyduck\FactorioModPortalClient\Response\ModResponse;

/**
 * The endpoint of the full mod request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class FullModRequestEndpoint implements EndpointInterface
{
    /**
     * Returns the request class supported by the endpoint.
     * @return string
     */
    public function getSupportedRequestClass(): string
    {
        return FullModRequest::class;
    }

    /**
     * Returns the request path of the endpoint.
     * @param RequestInterface $request
     * @return string
     */
    public function getRequestPath(RequestInterface $request): string
    {
        /* @var FullModRequest $request */
        return sprintf('/mods/%s/full', $request->getName());
    }

    /**
     * Creates the response of the endpoint.
     * @return string
     */
    public function getResponseClass(): string
    {
        return ModResponse::class;
    }
}
