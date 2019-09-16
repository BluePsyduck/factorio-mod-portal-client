# Factorio Mod Portal Client

[![Latest Stable Version](https://poser.pugx.org/bluepsyduck/factorio-mod-portal-client/v/stable)](https://packagist.org/packages/bluepsyduck/factorio-mod-portal-client) 
[![License](https://poser.pugx.org/bluepsyduck/factorio-mod-portal-client/license)](https://packagist.org/packages/bluepsyduck/factorio-mod-portal-client) 
[![Build Status](https://travis-ci.com/BluePsyduck/factorio-mod-portal-client.svg?branch=master)](https://travis-ci.com/BluePsyduck/factorio-mod-portal-client) 
[![codecov](https://codecov.io/gh/BluePsyduck/factorio-mod-portal-client/branch/master/graph/badge.svg)](https://codecov.io/gh/BluePsyduck/factorio-mod-portal-client)

This library implements a PHP client to access the API of the [Factorio Mod Portal](https://mods.factorio.com/).

## Usage

The client is shipped with a `ConfigProvider` to directly integrate it into a Zend Expressive project. Using it in other
contexts will require additional configuration not covered by this README file.

To use the client in a Zend Expressive context, add the `BluePsyduck\FactorioModPortalClient\ConfigProvider` to your
config aggregator, and fetch the actual client or the facade from the container. 

### Configuration

The client provides a zero-config setup. Yet, to use the full feature set, few values are required to be configured:

```php
<?php

use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;

return [
    ConfigKey::MAIN => [
        ConfigKey::OPTIONS => [
            // Your Factorio username. This username is used to build a full download link, avoiding getting redirected
            // to the login page. 
            // See https://wiki.factorio.com/Mod_portal_API#Downloading_Mods for further details.
            ConfigKey::OPTION_USERNAME => 'your-username',
            // The token to your username.
            ConfigKey::OPTION_TOKEN => 'your-token',

            // The timeout in seconds to use for the request. Defaults to 10 seconds.
            ConfigKey::OPTION_TIMEOUT => 10,
        ],
    ],
];
```

### Example

There are basically two approaches to requesting data from the mod portal API: Using the facade for simple access,
and using the client directly for the full set of features.

Using the facade is straight forward: Request the facade instance from the container, pass the requests in and get the 
responses back:

```php
<?php
/* @var \Psr\Container\ContainerInterface $container */

use BluePsyduck\FactorioModPortalClient\Client\Facade;
use BluePsyduck\FactorioModPortalClient\Request\ModRequest; 

/* @var Facade $facade */
$facade = $container->get(Facade::class);

$mod = $facade->getMod((new ModRequest())->setName('FARL'));

// Do something with the received mod.
var_dump($mod->getDownloadsCount());
```

Using the client itself allows you to make parallel requests using the [Promises](https://github.com/guzzle/promises)
returned by the client for the requests.

```php
<?php
/* @var \Psr\Container\ContainerInterface $container */

use BluePsyduck\FactorioModPortalClient\Client\ClientInterface;
use BluePsyduck\FactorioModPortalClient\Request\ModRequest; 
use BluePsyduck\FactorioModPortalClient\Response\ModResponse;
use function GuzzleHttp\Promise\all;

/* @var ClientInterface $client */
$client = $container->get(ClientInterface::class);

$request1 = (new ModRequest())->setName('FARL');
$request2 = (new ModRequest())->setName('FNEI');

/* @var ModResponse[] $responses*/
$responses = all([
    'FARL' => $client->sendRequest($request1),
    'FNEI' => $client->sendRequest($request2)
])->wait();

// Do something with the responses
var_dump($responses['FARL']->getSummary());
var_dump($responses['FNEI']->getSummary());
``` 

Additionally, both the facade and the client provide methods to transform download and asset paths to their full URL:
```php
<?php 
/* @var BluePsyduck\FactorioModPortalClient\Client\Facade $facade */
/* @var BluePsyduck\FactorioModPortalClient\Response\ModResponse $response */

$downloadUrl = $facade->getDownloadUrl($response->getReleases()[0]->getDownloadUrl());
$thumbnail = $facade->getAssetUrl($response->getThumbnail());
```
