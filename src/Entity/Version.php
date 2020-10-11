<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Entity;

/**
 * The class representing a version of either the game or a mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Version
{
    /**
     * The major part of the version.
     * @var int
     */
    protected $major = 0;

    /**
     * The minor part of the version.
     * @var int
     */
    protected $minor = 0;

    /**
     * The patch part of the version.
     * @var int
     */
    protected $patch = 0;

    /**
     * Initializes the version instance.
     * @param string $versionString
     */
    public function __construct(string $versionString = '')
    {
        $parts = array_map('intval', explode('.', $versionString));

        $this->major = $parts[0] ?? 0;
        $this->minor = $parts[1] ?? 0;
        $this->patch = $parts[2] ?? 0;
    }

    /**
     * Returns the major part of the version.
     * @return int
     */
    public function getMajor(): int
    {
        return $this->major;
    }

    /**
     * Returns the minor part of the version.
     * @return int
     */
    public function getMinor(): int
    {
        return $this->minor;
    }

    /**
     * Returns the patch part of the version.
     * @return int
     */
    public function getPatch(): int
    {
        return $this->patch;
    }

    /**
     * Returns the string representation of the version.
     * @return string
     */
    public function __toString()
    {
        return implode('.', [$this->major, $this->minor, $this->patch]);
    }

    /**
     * Compares the instance to the specified version.
     * @param Version $version
     * @return int -1 if the current instance has the smaller version, +1 if it is bigger, 0 if both are equal.
     */
    public function compareTo(Version $version): int
    {
        $parts = [
            $this->major <=> $version->getMajor(),
            $this->minor <=> $version->getMinor(),
            $this->patch <=> $version->getPatch(),
        ];

        $result = 0;
        for ($i = 0; $i < 3 && $result === 0; ++$i) {
            $result = $parts[$i];
        }
        return $result;
    }

    /**
     * Checks whether the version is compatible to the current one.
     * This pays attention that the versions 0.18 and 1.0 are basically the same and get treated as compatible.
     * @param Version $version
     * @return bool
     */
    public function isCompatibleTo(Version $version): bool
    {
        return ($this->major === $version->getMajor() && $this->minor === $version->getMinor())
            || ($this->major === 0 && $this->minor === 18 && $version->getMajor() === 1 && $version->getMinor() === 0)
            || ($this->major === 1 && $this->minor === 0 && $version->getMajor() === 0 && $version->getMinor() === 18);
    }
}
