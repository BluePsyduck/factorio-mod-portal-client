<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Entity;

/**
 * The entity representing the pagination of a list result.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Pagination
{
    /**
     * The number of results in the list.
     * @var int
     */
    protected $count = 0;

    /**
     * The current page of the list.
     * @var int
     */
    protected $page = 0;

    /**
     * The number of pages of the list.
     * @var int
     */
    protected $pageCount = 0;

    /**
     * The size of the pages.
     * @var int
     */
    protected $pageSize = 0;

    /**
     * The links to other pages of the list.
     * @var Links
     */
    protected $links;

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->links = new Links();
    }

    /**
     * Sets the number of results in the list.
     * @param int $count
     * @return $this
     */
    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Returns the number of results in the list.
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Sets the current page of the list.
     * @param int $page
     * @return $this
     */
    public function setPage(int $page): self
    {
        $this->page = $page;
        return $this;
    }

    /**
     * Returns the current page of the list.
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * Sets the number of pages of the list.
     * @param int $pageCount
     * @return $this
     */
    public function setPageCount(int $pageCount): self
    {
        $this->pageCount = $pageCount;
        return $this;
    }

    /**
     * Returns the number of pages of the list.
     * @return int
     */
    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    /**
     * Sets the size of the pages.
     * @param int $pageSize
     * @return $this
     */
    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * Returns the size of the pages.
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * Sets the links to other pages of the list.
     * @param Links $links
     * @return $this
     */
    public function setLinks(Links $links): self
    {
        $this->links = $links;
        return $this;
    }

    /**
     * Returns the links to other pages of the list.
     * @return Links
     */
    public function getLinks(): Links
    {
        return $this->links;
    }
}
