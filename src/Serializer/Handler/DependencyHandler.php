<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Serializer\Handler;

use BluePsyduck\FactorioModPortalClient\Entity\Dependency;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;

/**
 * The handler for the dependency type.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class DependencyHandler implements SubscribingHandlerInterface
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
                'type' => 'dependency',
                'method' => 'deserializeDependency',
            ],
        ];
    }

    /**
     * Deserializes the version, using its constructor.
     * @param DeserializationVisitorInterface $visitor
     * @param mixed $data
     * @param array|string[] $type
     * @return Dependency|null
     */
    public function deserializeDependency(DeserializationVisitorInterface $visitor, $data, array $type): ?Dependency
    {
        return new Dependency($visitor->visitString($data, $type));
    }
}
