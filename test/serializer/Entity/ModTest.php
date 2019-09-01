<?php

declare(strict_types=1);

namespace BluePsyduckTestSerializer\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\Mod;
use BluePsyduck\FactorioModPortalClient\Entity\Release;
use BluePsyduckTestAsset\FactorioModPortalClient\SerializerTestCase;
use DateTimeImmutable;

/**
 * The serializer test for the Mod class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ModTest extends SerializerTestCase
{
    /**
     * Tests the deserializing.
     */
    public function testDeserialize(): void
    {
        $data = [
            'category' => 'abc',
            'changelog' => 'def',
            'created_at' => '2039-01-15T03:14:07.123456Z',
            'description' => 'ghi',
            'downloads_count' => 1337,
            'github_path' => 'jkl',
            'homepage' => 'mno',
            'latest_release' => [
                'version' => '1.2.3',
                'released_at' => '2039-01-16T03:14:07.123456Z',
            ],
            'license' => [
                'name' => 'pqr',
            ],
            'name' => 'stu',
            'owner' => 'vwx',
            'releases' => [
                [
                    'version' => '0.1.2',
                    'released_at' => '2039-01-17T03:14:07.123456Z',
                ],
                [
                    'version' => '1.2.3',
                    'released_at' => '2039-01-18T03:14:07.123456Z',
                ],
            ],
            'score' => 13.37,
            'summary' => 'yza',
            'thumbnail' => 'bcd',
            'title' => 'efg',
            'updated_at' => '2039-01-19T03:14:07.123456Z',
        ];

        $release1 = new Release();
        $release1->setVersion('1.2.3')
                 ->setReleasedAt(new DateTimeImmutable('2039-01-16T03:14:07.123456Z'));
        $release2 = new Release();
        $release2->setVersion('0.1.2')
                 ->setReleasedAt(new DateTimeImmutable('2039-01-17T03:14:07.123456Z'));
        $release3 = new Release();
        $release3->setVersion('1.2.3')
                 ->setReleasedAt(new DateTimeImmutable('2039-01-18T03:14:07.123456Z'));

        $expectedObject = new Mod();
        $expectedObject->setCategory('abc')
                       ->setChangelog('def')
                       ->setCreatedAt(new DateTimeImmutable('2039-01-15T03:14:07.123456Z'))
                       ->setDescription('ghi')
                       ->setDownloadsCount(1337)
                       ->setGithubPath('jkl')
                       ->setHomepage('mno')
                       ->setLatestRelease($release1)
                       ->setName('stu')
                       ->setOwner('vwx')
                       ->setScore(13.37)
                       ->setSummary('yza')
                       ->setReleases([$release2, $release3])
                       ->setThumbnail('bcd')
                       ->setTitle('efg')
                       ->setUpdatedAt(new DateTimeImmutable('2039-01-19T03:14:07.123456Z'));
        $expectedObject->getLicense()->setName('pqr');

        $this->assertDeserializedObject($data, $expectedObject);
    }

    /**
     * Tests the deserializing.
     */
    public function testDeserializeWithoutLatestRelease(): void
    {
        $data = [
            'category' => 'abc',
            'changelog' => 'def',
            'created_at' => '2039-01-15T03:14:07.123456Z',
            'description' => 'ghi',
            'downloads_count' => 1337,
            'github_path' => 'jkl',
            'homepage' => 'mno',
            'license' => [
                'name' => 'pqr',
            ],
            'name' => 'stu',
            'owner' => 'vwx',
            'releases' => [
                [
                    'version' => '0.1.2',
                    'released_at' => '2039-01-17T03:14:07.123456Z',
                ],
                [
                    'version' => '1.2.3',
                    'released_at' => '2039-01-18T03:14:07.123456Z',
                ],
            ],
            'score' => 13.37,
            'summary' => 'yza',
            'thumbnail' => 'bcd',
            'title' => 'efg',
            'updated_at' => '2039-01-19T03:14:07.123456Z',
        ];

        $release2 = new Release();
        $release2->setVersion('0.1.2')
                 ->setReleasedAt(new DateTimeImmutable('2039-01-17T03:14:07.123456Z'));
        $release3 = new Release();
        $release3->setVersion('1.2.3')
                 ->setReleasedAt(new DateTimeImmutable('2039-01-18T03:14:07.123456Z'));

        $expectedObject = new Mod();
        $expectedObject->setCategory('abc')
                       ->setChangelog('def')
                       ->setCreatedAt(new DateTimeImmutable('2039-01-15T03:14:07.123456Z'))
                       ->setDescription('ghi')
                       ->setDownloadsCount(1337)
                       ->setGithubPath('jkl')
                       ->setHomepage('mno')
                       ->setLatestRelease(null)
                       ->setName('stu')
                       ->setOwner('vwx')
                       ->setScore(13.37)
                       ->setSummary('yza')
                       ->setReleases([$release2, $release3])
                       ->setThumbnail('bcd')
                       ->setTitle('efg')
                       ->setUpdatedAt(new DateTimeImmutable('2039-01-19T03:14:07.123456Z'));
        $expectedObject->getLicense()->setName('pqr');

        $this->assertDeserializedObject($data, $expectedObject);
    }
}
