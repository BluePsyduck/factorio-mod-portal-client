<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Entity;

/**
 * The entity representing the license information of a mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class License
{
    /**
     * The name of the license.
     * @var string
     */
    protected $name = '';

    /**
     * The URL to the license.
     * @var string
     */
    protected $url = '';

    /**
     * Sets the name of the license.
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the license.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the URL to the license.
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Returns the URL to the license.
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
