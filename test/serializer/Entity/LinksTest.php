<?php

declare(strict_types=1);

namespace BluePsyduckTestSerializer\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\Links;
use BluePsyduckTestAsset\FactorioModPortalClient\SerializerTestCase;

/**
 * The serializer test for the Links class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class LinksTest extends SerializerTestCase
{
    /**
     * Tests the deserializing.
     */
    public function testDeserialize(): void
    {
        $data = [
            'first' => 'abc',
            'prev' => 'def',
            'next' => 'ghi',
            'last' => 'jkl',
        ];

        $expectedObject = new Links();
        $expectedObject->setFirst('abc')
                       ->setPrev('def')
                       ->setNext('ghi')
                       ->setLast('jkl');

        $this->assertDeserializedObject($data, $expectedObject);
    }

    /**
     * Tests the deserializing.
     */
    public function testDeserializeWithEmptyData(): void
    {
        $data = [
            'first' => null,
            'prev' => null,
            'next' => null,
            'last' => null,
        ];

        $expectedObject = new Links();
        $expectedObject->setFirst(null)
                       ->setPrev(null)
                       ->setNext(null)
                       ->setLast(null);

        $this->assertDeserializedObject($data, $expectedObject);
    }
}
