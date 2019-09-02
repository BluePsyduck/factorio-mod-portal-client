<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Client;

/**
 * The options of the client.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Options
{
    /**
     * The URL of the API server, excluding the trailing /mods.
     * @var string
     */
    protected $apiUrl = '';

    /**
     * The timeout to use for the requests, in seconds.
     * @var int
     */
    protected $timeout = 0;

    /**
     * The username to use when generating the full download links of mods.
     * @var string
     */
    protected $username = '';

    /**
     * The token to use when generating the full download links of mods.
     * @var string
     */
    protected $token = '';

    /**
     * Sets the URL of the API server, excluding the trailing /mods.
     * @param string $apiUrl
     * @return $this
     */
    public function setApiUrl(string $apiUrl): self
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * Returns the URL of the API server, excluding the trailing /mods.
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * Sets the timeout to use for the requests, in seconds.
     * @param int $timeout
     * @return $this
     */
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * Returns the timeout to use for the requests, in seconds.
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * Sets the username to use when generating the full download links of mods.
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Returns the username to use when generating the full download links of mods.
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Sets the token to use when generating the full download links of mods.
     * @param string $token
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Returns the token to use when generating the full download links of mods.
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
