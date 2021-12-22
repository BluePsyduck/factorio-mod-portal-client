<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Endpoint;

use BluePsyduck\FactorioModPortalClient\Request\ModRequest;
use BluePsyduck\FactorioModPortalClient\Request\RequestInterface;
use BluePsyduck\FactorioModPortalClient\Response\ModResponse;

/**
 * The endpoint of the mod request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModEndpoint implements EndpointInterface
{
    /**
     * Returns the request class supported by the endpoint.
     * @return string
     */
    public function getSupportedRequestClass(): string
    {
        return ModRequest::class;
    }

    /**
     * Returns the request path of the endpoint.
     * @param RequestInterface $request
     * @return string
     */
    public function getRequestPath(RequestInterface $request): string
    {
        /** @var ModRequest $request */
        return sprintf('/mods/%s', $request->getName());
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
