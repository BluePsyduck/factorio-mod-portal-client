<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Serializer\Handler;

use BluePsyduck\FactorioModPortalClient\Entity\Version;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;

/**
 * The handler for the version type.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class VersionHandler implements SubscribingHandlerInterface
{
    /**
     * Returns the methods to subscribe to.
     * @return array<mixed>
     */
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'version',
                'method' => 'deserializeVersion',
            ],
        ];
    }

    /**
     * Deserializes the version, using its constructor.
     * @param DeserializationVisitorInterface $visitor
     * @param mixed $data
     * @param array|string[] $type
     * @return Version|null
     */
    public function deserializeVersion(DeserializationVisitorInterface $visitor, $data, array $type): ?Version
    {
        return new Version($visitor->visitString($data, $type));
    }
}
