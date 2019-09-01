<?php

declare(strict_types=1);

namespace BluePsyduckTestSerializer\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\InfoJson;
use BluePsyduckTestAsset\FactorioModPortalClient\SerializerTestCase;

/**
 * The serializer test for the InfoJson class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class InfoJsonTest extends SerializerTestCase
{
    /**
     * Tests the deserializing.
     */
    public function testDeserialize(): void
    {
        $data = [
            'dependencies' => [
                0 => 'abc',
                1 => 'def',
            ],
            'factorio_version' => '1.2.3',
        ];

        $expectedObject = new InfoJson();
        $expectedObject->setDependencies(['abc', 'def'])
                       ->setFactorioVersion('1.2.3');

        $this->assertDeserializedObject($data, $expectedObject);
    }
}
