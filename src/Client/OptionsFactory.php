<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

/**
 * The factory of the options.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class OptionsFactory
{
    /**
     * Creates the options.
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  array<mixed>|null $options
     * @return Options
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Options
    {
        $config = $container->get('config');
        $optionsConfig = $config[ConfigKey::MAIN][ConfigKey::OPTIONS] ?? []; // @phpstan-ignore-line

        $result = new Options();
        $result->setApiUrl($optionsConfig[ConfigKey::OPTION_API_URL] ?? '') // @phpstan-ignore-line
               ->setTimeout($optionsConfig[ConfigKey::OPTION_TIMEOUT] ?? 0) // @phpstan-ignore-line
               ->setDownloadUrlTemplate(
                   $optionsConfig[ConfigKey::OPTION_DOWNLOAD_URL_TEMPLATE] ?? '' // @phpstan-ignore-line
               )
               ->setAssetUrlTemplate($optionsConfig[ConfigKey::OPTION_ASSET_URL_TEMPLATE] ?? '') // @phpstan-ignore-line
               ->setUsername($optionsConfig[ConfigKey::OPTION_USERNAME] ?? '') // @phpstan-ignore-line
               ->setToken($optionsConfig[ConfigKey::OPTION_TOKEN] ?? ''); // @phpstan-ignore-line

        return $result;
    }
}
