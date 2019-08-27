<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\InfoJson;
use BluePsyduck\FactorioModPortalClient\Entity\Release;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Release class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Entity\Release
 */
class ReleaseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $entity = new Release();

        $this->assertSame('', $entity->getDownloadUrl());
        $this->assertSame('', $entity->getFileName());
        $this->assertSame('', $entity->getVersion());
        $this->assertSame('', $entity->getSha1());

        // Asserted through type-hinting
        $entity->getInfoJson();
        $entity->getReleasedAt();
    }

    /**
     * Tests the setting and getting the download url.
     * @covers ::getDownloadUrl
     * @covers ::setDownloadUrl
     */
    public function testSetAndGetDownloadUrl(): void
    {
        $downloadUrl = 'abc';
        $entity = new Release();

        $this->assertSame($entity, $entity->setDownloadUrl($downloadUrl));
        $this->assertSame($downloadUrl, $entity->getDownloadUrl());
    }

    /**
     * Tests the setting and getting the file name.
     * @covers ::getFileName
     * @covers ::setFileName
     */
    public function testSetAndGetFileName(): void
    {
        $fileName = 'abc';
        $entity = new Release();

        $this->assertSame($entity, $entity->setFileName($fileName));
        $this->assertSame($fileName, $entity->getFileName());
    }

    /**
     * Tests the setting and getting the info json.
     * @covers ::getInfoJson
     * @covers ::setInfoJson
     */
    public function testSetAndGetInfoJson(): void
    {
        $infoJson = new InfoJson();
        $entity = new Release();

        $this->assertSame($entity, $entity->setInfoJson($infoJson));
        $this->assertSame($infoJson, $entity->getInfoJson());
    }

    /**
     * Tests the setting and getting the released at.
     * @covers ::getReleasedAt
     * @covers ::setReleasedAt
     */
    public function testSetAndGetReleasedAt(): void
    {
        $releasedAt = new DateTimeImmutable('2038-01-19T03:14:07Z');
        $entity = new Release();

        $this->assertSame($entity, $entity->setReleasedAt($releasedAt));
        $this->assertSame($releasedAt, $entity->getReleasedAt());
    }

    /**
     * Tests the setting and getting the version.
     * @covers ::getVersion
     * @covers ::setVersion
     */
    public function testSetAndGetVersion(): void
    {
        $version = '1.2.3';
        $entity = new Release();

        $this->assertSame($entity, $entity->setVersion($version));
        $this->assertSame($version, $entity->getVersion());
    }

    /**
     * Tests the setting and getting the sha 1.
     * @covers ::getSha1
     * @covers ::setSha1
     */
    public function testSetAndGetSha1(): void
    {
        $sha1 = sha1('test');
        $entity = new Release();

        $this->assertSame($entity, $entity->setSha1($sha1));
        $this->assertSame($sha1, $entity->getSha1());
    }
}
