<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Request;

/**
 * The class for requesting a list of mods.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModListRequest implements RequestInterface
{
    /**
     * The page to request.
     * @var int|null
     */
    protected $page;

    /**
     * The size of the page to request.
     * @var int|null
     */
    protected $pageSize;

    /**
     * The names of the mods to request.
     * @var array|string[]
     */
    protected $nameList = [];

    /**
     * Sets the page to request.
     * @param int|null $page
     * @return $this
     */
    public function setPage(?int $page): self
    {
        $this->page = $page;
        return $this;
    }

    /**
     * Returns the page to request.
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * Sets the size of the page to request.
     * @param int|null $pageSize
     * @return $this
     */
    public function setPageSize(?int $pageSize): self
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * Returns the size of the page to request.
     * @return int|null
     */
    public function getPageSize(): ?int
    {
        return $this->pageSize;
    }

    /**
     * Sets the names of the mods to request.
     * @param array|string[] $nameList
     * @return $this
     */
    public function setNameList(array $nameList): self
    {
        $this->nameList = $nameList;
        return $this;
    }

    /**
     * Returns the names of the mods to request.
     * @return array|string[]
     */
    public function getNameList(): array
    {
        return $this->nameList;
    }
}
