<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Constant\ServiceName;
use BluePsyduck\FactorioModPortalClient\Service\EndpointService;
use Psr\Container\ContainerInterface;

/**
 * The factory for the client.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ClientFactory
{
    /**
     * Creates the client.
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return Client
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Client
    {
        return new Client(
            $container->get(EndpointService::class),
            $container->get(Options::class),
            $container->get(ServiceName::SERIALIZER)
        );
    }
}
