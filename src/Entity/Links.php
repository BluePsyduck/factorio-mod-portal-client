<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Entity;

/**
 * The entity representing the links of the pagination.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Links
{
    /**
     * The link to the first page of the result list.
     * @var string|null
     */
    protected $first;

    /**
     * The link to the previous page of the results.
     * @var string|null
     */
    protected $prev;

    /**
     * The link to the next page of the results.
     * @var string|null
     */
    protected $next;

    /**
     * The link to the last page of the results.
     * @var string|null
     */
    protected $last;

    /**
     * Sets the link to the first page of the result list.
     * @param string|null $first
     * @return $this
     */
    public function setFirst(?string $first): self
    {
        $this->first = $first;
        return $this;
    }

    /**
     * Returns the link to the first page of the result list.
     * @return string|null
     */
    public function getFirst(): ?string
    {
        return $this->first;
    }

    /**
     * Sets the link to the previous page of the results.
     * @param string|null $prev
     * @return $this
     */
    public function setPrev(?string $prev): self
    {
        $this->prev = $prev;
        return $this;
    }

    /**
     * Returns the link to the previous page of the results.
     * @return string|null
     */
    public function getPrev(): ?string
    {
        return $this->prev;
    }

    /**
     * Sets the link to the next page of the results.
     * @param string|null $next
     * @return $this
     */
    public function setNext(?string $next): self
    {
        $this->next = $next;
        return $this;
    }

    /**
     * Returns the link to the next page of the results.
     * @return string|null
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * Sets the link to the last page of the results.
     * @param string|null $last
     * @return $this
     */
    public function setLast(?string $last): self
    {
        $this->last = $last;
        return $this;
    }

    /**
     * Returns the link to the last page of the results.
     * @return string|null
     */
    public function getLast(): ?string
    {
        return $this->last;
    }
}
