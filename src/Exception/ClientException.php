<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Exception;

use Exception;

/**
 * The base exception thrown by the client.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ClientException extends Exception
{
    /**
     * The request which was tried to be executed.
     * @var string
     */
    protected $request = '';

    /**
     * The response which has been received.
     * @var string
     */
    protected $response = '';

    /**
     * Initializes the exception.
     * @param string $message
     * @param int $code
     * @param string $request
     * @param string $response
     * @param Exception|null $previous
     */
    public function __construct(
        string $message,
        int $code = 0,
        string $request = '',
        string $response = '',
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Returns the request which was tried to be executed.
     * @return string
     */
    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * Returns the response which has been received.
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }
}
