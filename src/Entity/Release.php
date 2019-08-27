<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Entity;

use DateTimeImmutable;
use DateTimeInterface;

/**
 * The entity representing an actual release of a mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Release
{
    /**
     * The download URL for this release of the mod.
     * @var string
     */
    protected $downloadUrl = '';

    /**
     * The file name of the release.
     * @var string
     */
    protected $fileName = '';

    /**
     * The data of the info.json file.
     * @var InfoJson
     */
    protected $infoJson;

    /**
     * The timestamp of the release.
     * @var DateTimeInterface
     */
    protected $releasedAt;

    /**
     * The version of the release.
     * @var string
     */
    protected $version = '';

    /**
     * The sha1 hash of the release file.
     * @var string
     */
    protected $sha1 = '';

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->releasedAt = new DateTimeImmutable();
        $this->infoJson = new InfoJson();
    }

    /**
     * Sets the download URL for this release of the mod.
     * @param string $downloadUrl
     * @return $this
     */
    public function setDownloadUrl(string $downloadUrl): self
    {
        $this->downloadUrl = $downloadUrl;
        return $this;
    }

    /**
     * Returns the download URL for this release of the mod.
     * @return string
     */
    public function getDownloadUrl(): string
    {
        return $this->downloadUrl;
    }

    /**
     * Sets the file name of the release.
     * @param string $fileName
     * @return $this
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * Returns the file name of the release.
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Sets the data of the info.json file.
     * @param InfoJson $infoJson
     * @return $this
     */
    public function setInfoJson(InfoJson $infoJson): self
    {
        $this->infoJson = $infoJson;
        return $this;
    }

    /**
     * Returns the data of the info.json file.
     * @return InfoJson
     */
    public function getInfoJson(): InfoJson
    {
        return $this->infoJson;
    }

    /**
     * Sets the timestamp of the release.
     * @param DateTimeInterface $releasedAt
     * @return $this
     */
    public function setReleasedAt(DateTimeInterface $releasedAt): self
    {
        $this->releasedAt = $releasedAt;
        return $this;
    }

    /**
     * Returns the timestamp of the release.
     * @return DateTimeInterface
     */
    public function getReleasedAt(): DateTimeInterface
    {
        return $this->releasedAt;
    }

    /**
     * Sets the version of the release.
     * @param string $version
     * @return $this
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Returns the version of the release.
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Sets the sha1 hash of the release file.
     * @param string $sha1
     * @return $this
     */
    public function setSha1(string $sha1): self
    {
        $this->sha1 = $sha1;
        return $this;
    }

    /**
     * Returns the sha1 hash of the release file.
     * @return string
     */
    public function getSha1(): string
    {
        return $this->sha1;
    }
}
