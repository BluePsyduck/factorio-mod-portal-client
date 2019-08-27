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
     * @var array|string[]
     */
    protected $dependencies = [];

    /**
     * The version of Factorio the release requires.
     * @var string
     */
    protected $factorioVersion = '';

    /**
     * Sets the dependencies of the release.
     * @param array|string[] $dependencies
     * @return $this
     */
    public function setDependencies(array $dependencies): self
    {
        $this->dependencies = $dependencies;
        return $this;
    }

    /**
     * Returns the dependencies of the release.
     * @return array|string[]
     */
    public function getDependencies(): array
    {
        return $this->dependencies;
    }

    /**
     * Sets the version of Factorio the release requires.
     * @param string $factorioVersion
     * @return $this
     */
    public function setFactorioVersion(string $factorioVersion): self
    {
        $this->factorioVersion = $factorioVersion;
        return $this;
    }

    /**
     * Returns the version of Factorio the release requires.
     * @return string
     */
    public function getFactorioVersion(): string
    {
        return $this->factorioVersion;
    }
}
