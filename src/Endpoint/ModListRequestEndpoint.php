<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Endpoint;

use BluePsyduck\FactorioModPortalClient\Request\ModListRequest;
use BluePsyduck\FactorioModPortalClient\Request\RequestInterface;
use BluePsyduck\FactorioModPortalClient\Response\ModListResponse;

/**
 * The endpoint of the mod list request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModListRequestEndpoint implements EndpointInterface
{
    /**
     * Returns the request class supported by the endpoint.
     * @return string
     */
    public function getSupportedRequestClass(): string
    {
        return ModListRequest::class;
    }

    /**
     * Returns the request path of the endpoint.
     * @param RequestInterface $request
     * @return string
     */
    public function getRequestPath(RequestInterface $request): string
    {
        /* @var ModListRequest $request */

        $params = [];
        if ($request->getPage() !== null) {
            $params['page'] = $request->getPage();
        }
        if ($request->getPageSize() !== null) {
            $params['page_size'] = $request->getPageSize();
        }
        if (count($request->getNameList()) > 0) {
            $params['namelist'] = implode(',', $request->getNameList());
        }

        return sprintf('/mods?%s', http_build_query($params));
    }

    /**
     * Creates the response of the endpoint.
     * @return string
     */
    public function getResponseClass(): string
    {
        return ModListResponse::class;
    }
}
