<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Constant;

/**
 * The interface holding the names of services not registered with their class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface ServiceName
{
    /**
     * The service name of the JMS serializer.
     */
    public const SERIALIZER = 'factorio-mod-portal-client.serializer';
}
