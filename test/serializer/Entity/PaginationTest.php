<?php

declare(strict_types=1);

namespace BluePsyduckTestSerializer\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\Pagination;
use BluePsyduckTestAsset\FactorioModPortalClient\SerializerTestCase;

/**
 * The serializer test for the Pagination class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class PaginationTest extends SerializerTestCase
{
    /**
     * Tests the deserializing.
     */
    public function testDeserialize(): void
    {
        $data = [
            'count' => 1337,
            'page' => 42,
            'page_count' => 21,
            'page_size' => 27,
            'links' => [
                'first' => 'abc',
                'prev' => 'def',
                'next' => 'ghi',
                'last' => 'jkl',
            ],
        ];

        $expectedObject = new Pagination();
        $expectedObject->setCount(1337)
                       ->setPage(42)
                       ->setPageCount(21)
                       ->setPageSize(27);
        $expectedObject->getLinks()->setFirst('abc')
                                   ->setPrev('def')
                                   ->setNext('ghi')
                                   ->setLast('jkl');

        $this->assertDeserializedObject($data, $expectedObject);
    }
}
