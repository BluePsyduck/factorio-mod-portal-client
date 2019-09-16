<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Exception\ClientException;
use BluePsyduck\FactorioModPortalClient\Request\FullModRequest;
use BluePsyduck\FactorioModPortalClient\Request\ModListRequest;
use BluePsyduck\FactorioModPortalClient\Request\ModRequest;
use BluePsyduck\FactorioModPortalClient\Response\ModListResponse;
use BluePsyduck\FactorioModPortalClient\Response\ModResponse;

/**
 * The facade simplifying sending requests to the API.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Facade
{
    /**
     * The client.
     * @var ClientInterface
     */
    protected $client;

    /**
     * Initializes the facade.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Fetches a mod from the mod portal.
     * @param ModRequest $request
     * @return ModResponse
     * @throws ClientException
     */
    public function getMod(ModRequest $request): ModResponse
    {
        return $this->client->sendRequest($request)->wait();
    }

    /**
     * @param FullModRequest $request
     * @return ModResponse
     * @throws ClientException
     */
    public function getFullMod(FullModRequest $request): ModResponse
    {
        return $this->client->sendRequest($request)->wait();
    }

    /**
     * Fetches a mod list from the mod portal.
     * @param ModListRequest $request
     * @return ModListResponse
     * @throws ClientException
     */
    public function getModList(ModListRequest $request): ModListResponse
    {
        return $this->client->sendRequest($request)->wait();
    }

    /**
     * Returns the full download URL to a mod release.
     * @param string $downloadPath
     * @return string
     */
    public function getDownloadUrl(string $downloadPath): string
    {
        return $this->client->getDownloadUrl($downloadPath);
    }

    /**
     * Returns the full asset URL to e.g. a thumbnail.
     * @param string $assetPath
     * @return string
     */
    public function getAssetUrl(string $assetPath): string
    {
        return $this->client->getAssetUrl($assetPath);
    }
}
