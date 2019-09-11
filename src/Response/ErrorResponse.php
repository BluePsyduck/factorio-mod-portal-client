<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Response;

/**
 * The response containing an error.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ErrorResponse implements ResponseInterface
{
    /**
     * The error message.
     * @var string
     */
    protected $message = '';

    /**
     * Sets the error message.
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Returns the error message.
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
