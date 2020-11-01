<?php

declare(strict_types=1);

namespace BluePsyduckTestSerializer\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\Release;
use BluePsyduck\FactorioModPortalClient\Entity\Version;
use BluePsyduckTestAsset\FactorioModPortalClient\SerializerTestCase;
use DateTimeImmutable;

/**
 * The serializer test for the Release class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ReleaseTest extends SerializerTestCase
{
    /**
     * Tests the deserializing.
     */
    public function testDeserialize(): void
    {
        $data = [
            'download_url' => 'abc/def',
            'file_name' => 'ghi_1.2.3.zip',
            'info_json' => [
                'factorio_version' => '0.1.2',
            ],
            'released_at' => '2038-01-19T03:14:07.123456Z',
            'version' => '1.2.3',
            'sha1' => 'jkl',
        ];

        $expectedObject = new Release();
        $expectedObject->setDownloadUrl('abc/def')
                       ->setFileName('ghi_1.2.3.zip')
                       ->setReleasedAt(new DateTimeImmutable('2038-01-19T03:14:07.123456Z'))
                       ->setVersion(new Version('1.2.3'))
                       ->setSha1('jkl');
        $expectedObject->getInfoJson()->setFactorioVersion(new Version('0.1.2'));

        $this->assertDeserializedObject($data, $expectedObject);
    }
}
