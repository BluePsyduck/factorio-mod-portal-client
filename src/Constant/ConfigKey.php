<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Constant;

/**
 * The interface holding the keys of the config.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface ConfigKey
{
    /**
     * The main key holding the library configuration.
     */
    public const MAIN = 'factorio-mod-portal-client';

    /**
     * The key holding the cache directory to use.
     */
    public const CACHE_DIR = 'cache-dir';

    /**
     * The key for the endpoints.
     */
    public const ENDPOINTS = 'endpoints';

    /**
     * The key for the options.
     */
    public const OPTIONS = 'options';

    /**
     * The key for the API URL option.
     */
    public const OPTION_API_URL = 'api-url';

    /**
     * The key for the timeout option.
     */
    public const OPTION_TIMEOUT = 'timeout';

    /**
     * The key for the username option.
     */
    public const OPTION_USERNAME = 'username';

    /**
     * The key for the token option.
     */
    public const OPTION_TOKEN = 'token';
}
