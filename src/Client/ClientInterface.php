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

    /**
     * Returns the full download URL to a mod release.
     * @param string $downloadPath
     * @return string
     */
    public function getDownloadUrl(string $downloadPath): string;

    /**
     * Returns the full asset URL to e.g. a thumbnail.
     * @param string $assetPath
     * @return string
     */
    public function getAssetUrl(string $assetPath): string;
}
