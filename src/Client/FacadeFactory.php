<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Client;

use Psr\Container\ContainerInterface;

/**
 * The factory of the facade.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class FacadeFactory
{
    /**
     * Creates the client.
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  array<mixed>|null $options
     * @return Facade
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Facade
    {
        return new Facade(
            $container->get(ClientInterface::class)
        );
    }
}
