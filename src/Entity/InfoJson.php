<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Entity;

/**
 * The entity representing the data from the info.json file of a mod release.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class InfoJson
{
    /**
     * The dependencies of the release.
     * @var array|Dependency[]
     */
    protected $dependencies = [];

    /**
     * The version of Factorio the release requires.
     * @var Version
     */
    protected $factorioVersion;

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->factorioVersion = new Version();
    }

    /**
     * Sets the dependencies of the release.
     * @param array|Dependency[] $dependencies
     * @return $this
     */
    public function setDependencies(array $dependencies): self
    {
        $this->dependencies = $dependencies;
        return $this;
    }

    /**
     * Returns the dependencies of the release.
     * @return array|Dependency[]
     */
    public function getDependencies(): array
    {
        return $this->dependencies;
    }

    /**
     * Sets the version of Factorio the release requires.
     * @param Version $factorioVersion
     * @return $this
     */
    public function setFactorioVersion(Version $factorioVersion): self
    {
        $this->factorioVersion = $factorioVersion;
        return $this;
    }

    /**
     * Returns the version of Factorio the release requires.
     * @return Version
     */
    public function getFactorioVersion(): Version
    {
        return $this->factorioVersion;
    }
}
