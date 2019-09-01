<?php

declare(strict_types=1);

namespace BluePsyduckTestSerializer\FactorioModPortalClient\Response;

use BluePsyduck\FactorioModPortalClient\Entity\Mod;
use BluePsyduck\FactorioModPortalClient\Response\ModListResponse;
use BluePsyduckTestAsset\FactorioModPortalClient\SerializerTestCase;
use DateTimeImmutable;

/**
 * The serializer test for the ModListResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ModListResponseTest extends SerializerTestCase
{
    /**
     * Tests the deserializing.
     */
    public function testDeserialize(): void
    {
        $data = [
            'pagination' => [
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
            ],
            'results' => [
                [
                    'created_at' => '2039-01-16T03:14:07.123456Z',
                    'name' => 'abc',
                    'updated_at' => '2039-01-17T03:14:07.123456Z',
                ],
                [
                    'created_at' => '2039-01-18T03:14:07.123456Z',
                    'name' => 'def',
                    'updated_at' => '2039-01-19T03:14:07.123456Z',
                ]
            ],
        ];

        $mod1 = new Mod();
        $mod1->setCreatedAt(new DateTimeImmutable('2039-01-16T03:14:07.123456Z'))
             ->setName('abc')
             ->setUpdatedAt(new DateTimeImmutable('2039-01-17T03:14:07.123456Z'));
        $mod2 = new Mod();
        $mod2->setCreatedAt(new DateTimeImmutable('2039-01-18T03:14:07.123456Z'))
             ->setName('def')
             ->setUpdatedAt(new DateTimeImmutable('2039-01-19T03:14:07.123456Z'));

        $expectedObject = new ModListResponse();
        $expectedObject->getPagination()->setCount(1337)
                                        ->setPage(42)
                                        ->setPageCount(21)
                                        ->setPageSize(27);
        $expectedObject->getPagination()->getLinks()->setFirst('abc')
                                                    ->setPrev('def')
                                                    ->setNext('ghi')
                                                    ->setLast('jkl');
        $expectedObject->setResults([$mod1, $mod2]);

        $this->assertDeserializedObject($data, $expectedObject);
    }
}
