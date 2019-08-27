<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Request;

/**
 * The class for requesting a single mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModRequest implements RequestInterface
{
    /**
     * The name of the mod to request.
     * @var string
     */
    protected $name = '';

    /**
     * Sets the name of the mod to request.
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the mod to request.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
