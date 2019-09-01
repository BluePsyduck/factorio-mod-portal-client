<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Serializer;

use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;
use BluePsyduck\FactorioModPortalClient\Serializer\Construction\ObjectConstructor;
use BluePsyduck\FactorioModPortalClient\Serializer\Handler\SimpleDateTimeHandler;
use Interop\Container\ContainerInterface;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * The factory for the JMS serializer.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SerializerFactory implements FactoryInterface
{
    /**
     * Creates the serializer.
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return SerializerInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): SerializerInterface
    {
        $builder = SerializerBuilder::create();
        $builder
            ->addMetadataDir(
                (string) realpath(__DIR__ . '/../../config/serializer'),
                'BluePsyduck\FactorioModPortalClient'
            )
            ->addDefaultHandlers()
            ->configureHandlers(function (HandlerRegistry $registry): void {
                $registry->registerSubscribingHandler(new SimpleDateTimeHandler());
            })
            ->setObjectConstructor(new ObjectConstructor());

        $this->addCacheDirectory($container, $builder);

        return $builder->build();
    }

    /**
     * Adds the cache directory from the config to the builder.
     * @param ContainerInterface $container
     * @param SerializerBuilder $builder
     */
    protected function addCacheDirectory(ContainerInterface $container, SerializerBuilder $builder): void
    {
        $config = $container->get('config');
        $cacheDir = (string) ($config[ConfigKey::MAIN][ConfigKey::CACHE_DIR] ?? '');

        if ($cacheDir !== '') {
            $builder->setCacheDir($cacheDir);
        }
    }
}
