<?php

declare(strict_types=1);

/**
 * The config for the mod portal client itself.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace BluePsyduck\FactorioModPortalClient;

use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;

return [
    ConfigKey::MAIN => [
        // The options for the client itself.
        ConfigKey::OPTIONS => [
            // The URL to the API, ending with /api.
            ConfigKey::OPTION_API_URL => 'https://mods.factorio.com/api',
            // The timeout in seconds to use.
            ConfigKey::OPTION_TIMEOUT => 10,
            // The username to use for the download links to avoid the login screen.
            ConfigKey::OPTION_USERNAME => '',
            // The token for the username, retrievable from the Factorio page.
            ConfigKey::OPTION_TOKEN => '',
        ],

        // The container aliases of the endpoints to handle with the client.
        ConfigKey::ENDPOINTS => [
            Endpoint\FullModEndpoint::class,
            Endpoint\ModListEndpoint::class,
            Endpoint\ModEndpoint::class,
        ],
    ],
];
