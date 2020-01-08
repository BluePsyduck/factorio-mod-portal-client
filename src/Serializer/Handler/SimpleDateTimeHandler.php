<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Serializer\Handler;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;

/**
 * The handler for the simpleDateTime type, which uses the DateTime constructor to parse any date strings.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SimpleDateTimeHandler implements SubscribingHandlerInterface
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
                'type' => 'simpleDateTime',
                'method' => 'deserializeDateTime',
            ],
        ];
    }

    /**
     * Deserializes the datetime, using its constructor.
     * @param DeserializationVisitorInterface $visitor
     * @param mixed $data
     * @param array|string[] $type
     * @return DateTimeInterface|null
     * @throws Exception
     */
    public function deserializeDateTime(
        DeserializationVisitorInterface $visitor,
        $data,
        array $type
    ): ?DateTimeInterface {
        if ($data === null) {
            return null;
        }

        return new DateTimeImmutable($visitor->visitString($data, $type));
    }
}
