<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Response;

use BluePsyduck\FactorioModPortalClient\Entity\Pagination;
use BluePsyduck\FactorioModPortalClient\Entity\Mod;

/**
 * The response containing a list of mods.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModListResponse implements ResponseInterface
{
    /**
     * The pagination of the list response.
     * @var Pagination
     */
    protected $pagination;

    /**
     * The actual results.
     * @var array|Mod[]
     */
    protected $results = [];

    /**
     * Initializes the response.
     */
    public function __construct()
    {
        $this->pagination = new Pagination();
    }

    /**
     * Sets the pagination of the list response.
     * @param Pagination $pagination
     * @return $this
     */
    public function setPagination(Pagination $pagination): self
    {
        $this->pagination = $pagination;
        return $this;
    }

    /**
     * Returns the pagination of the list response.
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    /**
     * Sets the actual results.
     * @param array|Mod[] $results
     * @return $this
     */
    public function setResults(array $results): self
    {
        $this->results = $results;
        return $this;
    }

    /**
     * Returns the actual results.
     * @return array|Mod[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
