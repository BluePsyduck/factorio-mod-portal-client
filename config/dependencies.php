<?php

declare(strict_types=1);

/**
 * The configuration of the API client dependencies.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace BluePsyduck\FactorioModPortalClient;

use BluePsyduck\FactorioModPortalClient\Constant\ServiceName;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'dependencies' => [
        'factories'  => [
            Client\Options::class => Client\OptionsFactory::class,
            Client\ClientInterface::class => Client\ClientFactory::class,
            Client\Facade::class => Client\FacadeFactory::class,

            Endpoint\FullModEndpoint::class => InvokableFactory::class,
            Endpoint\ModListEndpoint::class => InvokableFactory::class,
            Endpoint\ModEndpoint::class => InvokableFactory::class,

            Service\EndpointService::class => Service\EndpointServiceFactory::class,

            // 3rd party dependencies
            ServiceName::SERIALIZER => Serializer\SerializerFactory::class,
        ],
    ],
];
