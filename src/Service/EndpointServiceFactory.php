<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Service;

use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;
use BluePsyduck\FactorioModPortalClient\Endpoint\EndpointInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

/**
 * The factory of the endpoint service.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class EndpointServiceFactory
{
    /**
     * Creates the service.
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  array<mixed>|null $options
     * @return EndpointService
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): EndpointService
    {
        $config = $container->get('config');
        $libraryConfig = $config[ConfigKey::MAIN] ?? []; // @phpstan-ignore-line
        /** @var array<string> $endpointAliases */
        $endpointAliases = $libraryConfig[ConfigKey::ENDPOINTS] ?? []; // @phpstan-ignore-line

        return new EndpointService($this->createEndpoints($container, $endpointAliases));
    }

    /**
     * Creates the fetchers to use.
     * @param ContainerInterface $container
     * @param array|string[] $aliases
     * @return array|EndpointInterface[]
     * @throws ContainerExceptionInterface
     */
    protected function createEndpoints(ContainerInterface $container, array $aliases): array
    {
        $result = [];
        foreach ($aliases as $alias) {
            /** @var EndpointInterface $endpoint */
            $endpoint = $container->get($alias);
            $result[] = $endpoint;
        }
        return $result;
    }
}
