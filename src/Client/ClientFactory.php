<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Constant\ServiceName;
use BluePsyduck\FactorioModPortalClient\Service\EndpointService;
use JMS\Serializer\SerializerInterface;
use Psr\Container\ContainerExceptionInterface;
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
     * @param  array<mixed>|null $options
     * @return Client
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Client
    {
        /** @var EndpointService $endpointService */
        $endpointService = $container->get(EndpointService::class);
        /** @var Options $options */
        $options = $container->get(Options::class);
        /** @var SerializerInterface $serializer */
        $serializer = $container->get(ServiceName::SERIALIZER);

        return new Client($endpointService, $options, $serializer);
    }
}
