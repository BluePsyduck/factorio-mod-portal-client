<?php

declare(strict_types=1);

/**
 * The config for the api-client library itself.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace BluePsyduck\FactorioModPortalClient;

use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;

return [
    ConfigKey::MAIN => [
        ConfigKey::ENDPOINTS => [
            Endpoint\FullModEndpoint::class,
            Endpoint\ModListEndpoint::class,
            Endpoint\ModEndpoint::class,
        ],
    ],
];
