<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Service;

use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;
use BluePsyduck\FactorioModPortalClient\Endpoint\EndpointInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * The factory of the endpoint service.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class EndpointServiceFactory implements FactoryInterface
{
    /**
     * Creates the service.
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return EndpointService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): EndpointService
    {
        $config = $container->get('config');
        $libraryConfig = $config[ConfigKey::MAIN] ?? [];

        return new EndpointService($this->createEndpoints($container, $libraryConfig[ConfigKey::ENDPOINTS] ?? []));
    }

    /**
     * Creates the fetchers to use.
     * @param ContainerInterface $container
     * @param array|string[] $aliases
     * @return array|EndpointInterface[]
     */
    protected function createEndpoints(ContainerInterface $container, array $aliases): array
    {
        $result = [];
        foreach ($aliases as $alias) {
            $result[] = $container->get($alias);
        }
        return $result;
    }
}
