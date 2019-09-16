<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\License;
use BluePsyduck\FactorioModPortalClient\Entity\Mod;
use BluePsyduck\FactorioModPortalClient\Entity\Release;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Mod class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Entity\Mod
 */
class ModTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $entity = new Mod();

        $this->assertSame('', $entity->getCategory());
        $this->assertSame('', $entity->getChangelog());
        $this->assertNull($entity->getCreatedAt());
        $this->assertSame('', $entity->getDescription());
        $this->assertSame(0, $entity->getDownloadsCount());
        $this->assertSame('', $entity->getGithubPath());
        $this->assertSame('', $entity->getHomepage());
        $this->assertNull($entity->getLatestRelease());
        $this->assertNull($entity->getLicense());
        $this->assertSame('', $entity->getName());
        $this->assertSame('', $entity->getOwner());
        $this->assertSame([], $entity->getReleases());
        $this->assertSame(0., $entity->getScore());
        $this->assertSame('', $entity->getSummary());
        $this->assertSame('', $entity->getThumbnail());
        $this->assertSame('', $entity->getTitle());
        $this->assertNull($entity->getUpdatedAt());
    }

    /**
     * Tests the setting and getting the category.
     * @covers ::getCategory
     * @covers ::setCategory
     */
    public function testSetAndGetCategory(): void
    {
        $category = 'abc';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setCategory($category));
        $this->assertSame($category, $entity->getCategory());
    }

    /**
     * Tests the setting and getting the changelog.
     * @covers ::getChangelog
     * @covers ::setChangelog
     */
    public function testSetAndGetChangelog(): void
    {
        $changelog = 'abc';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setChangelog($changelog));
        $this->assertSame($changelog, $entity->getChangelog());
    }

    /**
     * Tests the setting and getting the created at.
     * @covers ::getCreatedAt
     * @covers ::setCreatedAt
     */
    public function testSetAndGetCreatedAt(): void
    {
        $createdAt = new DateTimeImmutable('2038-01-19T03:14:07Z');
        $entity = new Mod();

        $this->assertSame($entity, $entity->setCreatedAt($createdAt));
        $this->assertSame($createdAt, $entity->getCreatedAt());
    }

    /**
     * Tests the setting and getting the description.
     * @covers ::getDescription
     * @covers ::setDescription
     */
    public function testSetAndGetDescription(): void
    {
        $description = 'abc';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setDescription($description));
        $this->assertSame($description, $entity->getDescription());
    }

    /**
     * Tests the setting and getting the downloads count.
     * @covers ::getDownloadsCount
     * @covers ::setDownloadsCount
     */
    public function testSetAndGetDownloadsCount(): void
    {
        $downloadsCount = 1337;
        $entity = new Mod();

        $this->assertSame($entity, $entity->setDownloadsCount($downloadsCount));
        $this->assertSame($downloadsCount, $entity->getDownloadsCount());
    }

    /**
     * Tests the setting and getting the github path.
     * @covers ::getGithubPath
     * @covers ::setGithubPath
     */
    public function testSetAndGetGithubPath(): void
    {
        $githubPath = 'abc';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setGithubPath($githubPath));
        $this->assertSame($githubPath, $entity->getGithubPath());
    }

    /**
     * Tests the setting and getting the homepage.
     * @covers ::getHomepage
     * @covers ::setHomepage
     */
    public function testSetAndGetHomepage(): void
    {
        $homepage = 'https://www.example.com/';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setHomepage($homepage));
        $this->assertSame($homepage, $entity->getHomepage());
    }

    /**
     * Tests the setting and getting the latest release.
     * @covers ::getLatestRelease
     * @covers ::setLatestRelease
     */
    public function testSetAndGetLatestRelease(): void
    {
        $latestRelease = new Release();
        $entity = new Mod();

        $this->assertSame($entity, $entity->setLatestRelease($latestRelease));
        $this->assertSame($latestRelease, $entity->getLatestRelease());
    }

    /**
     * Tests the setting and getting the license.
     * @covers ::getLicense
     * @covers ::setLicense
     */
    public function testSetAndGetLicense(): void
    {
        $license = new License();
        $entity = new Mod();

        $this->assertSame($entity, $entity->setLicense($license));
        $this->assertSame($license, $entity->getLicense());
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setName($name));
        $this->assertSame($name, $entity->getName());
    }

    /**
     * Tests the setting and getting the owner.
     * @covers ::getOwner
     * @covers ::setOwner
     */
    public function testSetAndGetOwner(): void
    {
        $owner = 'abc';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setOwner($owner));
        $this->assertSame($owner, $entity->getOwner());
    }

    /**
     * Tests the setting and getting the releases.
     * @covers ::getReleases
     * @covers ::setReleases
     */
    public function testSetAndGetReleases(): void
    {
        $releases = [new Release(), new Release()];
        $entity = new Mod();

        $this->assertSame($entity, $entity->setReleases($releases));
        $this->assertSame($releases, $entity->getReleases());
    }

    /**
     * Tests the setting and getting the score.
     * @covers ::getScore
     * @covers ::setScore
     */
    public function testSetAndGetScore(): void
    {
        $score = 13.37;
        $entity = new Mod();

        $this->assertSame($entity, $entity->setScore($score));
        $this->assertSame($score, $entity->getScore());
    }

    /**
     * Tests the setting and getting the summary.
     * @covers ::getSummary
     * @covers ::setSummary
     */
    public function testSetAndGetSummary(): void
    {
        $summary = 'abc';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setSummary($summary));
        $this->assertSame($summary, $entity->getSummary());
    }

    /**
     * Tests the setting and getting the thumbnail.
     * @covers ::getThumbnail
     * @covers ::setThumbnail
     */
    public function testSetAndGetThumbnail(): void
    {
        $thumbnail = 'https://www.example.com/thumb.jpg';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setThumbnail($thumbnail));
        $this->assertSame($thumbnail, $entity->getThumbnail());
    }

    /**
     * Tests the setting and getting the title.
     * @covers ::getTitle
     * @covers ::setTitle
     */
    public function testSetAndGetTitle(): void
    {
        $title = 'abc';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setTitle($title));
        $this->assertSame($title, $entity->getTitle());
    }

    /**
     * Tests the setting and getting the updated at.
     * @covers ::getUpdatedAt
     * @covers ::setUpdatedAt
     */
    public function testSetAndGetUpdatedAt(): void
    {
        $updatedAt = new DateTimeImmutable('2038-01-19T03:14:07Z');
        $entity = new Mod();

        $this->assertSame($entity, $entity->setUpdatedAt($updatedAt));
        $this->assertSame($updatedAt, $entity->getUpdatedAt());
    }
}
