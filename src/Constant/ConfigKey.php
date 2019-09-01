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
    public const MAIN = 'factorio-item-browser';

    /**
     * The key holding the cache directory to use.
     */
    public const CACHE_DIR = 'cache-dir';
}
