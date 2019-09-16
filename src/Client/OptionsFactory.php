<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Client;

use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * The factory of the options.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class OptionsFactory implements FactoryInterface
{
    /**
     * Creates the options.
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return Options
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Options
    {
        $config = $container->get('config');
        $optionsConfig = $config[ConfigKey::MAIN][ConfigKey::OPTIONS] ?? [];

        $result = new Options();
        $result->setApiUrl($optionsConfig[ConfigKey::OPTION_API_URL] ?? '')
               ->setTimeout($optionsConfig[ConfigKey::OPTION_TIMEOUT] ?? 0)
               ->setDownloadUrlTemplate($optionsConfig[ConfigKey::OPTION_DOWNLOAD_URL_TEMPLATE] ?? '')
               ->setAssetUrlTemplate($optionsConfig[ConfigKey::OPTION_ASSET_URL_TEMPLATE] ?? '')
               ->setUsername($optionsConfig[ConfigKey::OPTION_USERNAME] ?? '')
               ->setToken($optionsConfig[ConfigKey::OPTION_TOKEN] ?? '');

        return $result;
    }
}
