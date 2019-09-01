<?php

declare(strict_types=1);

namespace BluePsyduckTestSerializer\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\License;
use BluePsyduckTestAsset\FactorioModPortalClient\SerializerTestCase;

/**
 * The serializer test for the License class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class LicenseTest extends SerializerTestCase
{
    /**
     * Tests the deserializing.
     */
    public function testDeserialize(): void
    {
        $data = [
            'name' => 'abc',
            'url' => 'https://www.example.com/'
        ];

        $expectedObject = new License();
        $expectedObject->setName('abc')
                       ->setUrl('https://www.example.com/');

        $this->assertDeserializedObject($data, $expectedObject);
    }
}
