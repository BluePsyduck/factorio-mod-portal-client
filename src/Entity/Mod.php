<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Entity;

use DateTimeInterface;

/**
 * The entity representing a mod. Note that not all data is present in all endpoints of the API.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Mod
{
    /**
     * The category of the mod.
     * @var string
     */
    protected $category = '';

    /**
     * The changelog of the mod.
     * @var string
     */
    protected $changelog = '';

    /**
     * The timestamp when the mod was first created.
     * @var DateTimeInterface|null
     */
    protected $createdAt;

    /**
     * The description of the mod.
     * @var string
     */
    protected $description = '';

    /**
     * The number of downloads of the mod.
     * @var int
     */
    protected $downloadsCount = 0;

    /**
     * The Github path of the mod.
     * @var string
     */
    protected $githubPath = '';

    /**
     * The homepage URL of the mod.
     * @var string
     */
    protected $homepage = '';

    /**
     * The latest release of the mod.
     * @var Release|null
     */
    protected $latestRelease;

    /**
     * The license of the mod.
     * @var License
     */
    protected $license;

    /**
     * The internal name of the mod.
     * @var string
     */
    protected $name = '';

    /**
     * The owner of the mod.
     * @var string
     */
    protected $owner = '';

    /**
     * The releases of the mod.
     * @var array|Release[]
     */
    protected $releases = [];

    /**
     * The score of the mod.
     * @var float
     */
    protected $score = 0.;

    /**
     * The summary of the mod.
     * @var string
     */
    protected $summary = '';

    /**
     * The thumbnail of the mod.
     * @var string
     */
    protected $thumbnail = '';

    /**
     * The title of the mod.
     * @var string
     */
    protected $title = '';

    /**
     * The timestamp of when the mod was last updated.
     * @var DateTimeInterface|null
     */
    protected $updatedAt;

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->license = new License();
    }

    /**
     * Sets the category of the mod.
     * @param string $category
     * @return $this
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Returns the category of the mod.
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Sets the changelog of the mod.
     * @param string $changelog
     * @return $this
     */
    public function setChangelog(string $changelog): self
    {
        $this->changelog = $changelog;
        return $this;
    }

    /**
     * Returns the changelog of the mod.
     * @return string
     */
    public function getChangelog(): string
    {
        return $this->changelog;
    }

    /**
     * Sets the timestamp when the mod was first created.
     * @param DateTimeInterface|null $createdAt
     * @return $this
     */
    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Returns the timestamp when the mod was first created.
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Sets the description of the mod.
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Returns the description of the mod.
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the number of downloads of the mod.
     * @param int $downloadsCount
     * @return $this
     */
    public function setDownloadsCount(int $downloadsCount): self
    {
        $this->downloadsCount = $downloadsCount;
        return $this;
    }

    /**
     * Returns the number of downloads of the mod.
     * @return int
     */
    public function getDownloadsCount(): int
    {
        return $this->downloadsCount;
    }

    /**
     * Sets the Github path of the mod.
     * @param string $githubPath
     * @return $this
     */
    public function setGithubPath(string $githubPath): self
    {
        $this->githubPath = $githubPath;
        return $this;
    }

    /**
     * Returns the Github path of the mod.
     * @return string
     */
    public function getGithubPath(): string
    {
        return $this->githubPath;
    }

    /**
     * Sets the homepage URL of the mod.
     * @param string $homepage
     * @return $this
     */
    public function setHomepage(string $homepage): self
    {
        $this->homepage = $homepage;
        return $this;
    }

    /**
     * Returns the homepage URL of the mod.
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * Sets the latest release of the mod.
     * @param Release|null $latestRelease
     * @return $this
     */
    public function setLatestRelease(?Release $latestRelease): self
    {
        $this->latestRelease = $latestRelease;
        return $this;
    }

    /**
     * Returns the latest release of the mod.
     * @return Release|null
     */
    public function getLatestRelease(): ?Release
    {
        return $this->latestRelease;
    }

    /**
     * Sets the license of the mod.
     * @param License $license
     * @return $this
     */
    public function setLicense(License $license): self
    {
        $this->license = $license;
        return $this;
    }

    /**
     * Returns the license of the mod.
     * @return License
     */
    public function getLicense(): License
    {
        return $this->license;
    }

    /**
     * Sets the internal name of the mod.
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the internal name of the mod.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the owner of the mod.
     * @param string $owner
     * @return $this
     */
    public function setOwner(string $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Returns the owner of the mod.
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * Sets the releases of the mod.
     * @param array|Release[] $releases
     * @return $this
     */
    public function setReleases(array $releases): self
    {
        $this->releases = $releases;
        return $this;
    }

    /**
     * Returns the releases of the mod.
     * @return array|Release[]
     */
    public function getReleases(): array
    {
        return $this->releases;
    }

    /**
     * Sets the score of the mod.
     * @param float $score
     * @return $this
     */
    public function setScore(float $score): self
    {
        $this->score = $score;
        return $this;
    }

    /**
     * Returns the score of the mod.
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * Sets the summary of the mod.
     * @param string $summary
     * @return $this
     */
    public function setSummary(string $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Returns the summary of the mod.
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * Sets the thumbnail of the mod.
     * @param string $thumbnail
     * @return $this
     */
    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    /**
     * Returns the thumbnail of the mod.
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * Sets the title of the mod.
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Returns the title of the mod.
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the timestamp of when the mod was last updated.
     * @param DateTimeInterface|null $updatedAt
     * @return $this
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Returns the timestamp of when the mod was last updated.
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }
}
