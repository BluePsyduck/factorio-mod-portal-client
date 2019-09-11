<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Exception;

use Exception;

/**
 * The exception thrown when an invalid response is encountered.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class InvalidResponseException extends ClientException
{
    /**
     * The message template of the exception.
     */
    protected const MESSAGE = 'The response was invalid and could not be parsed: %s';

    /**
     * Initializes the exception.
     * @param string $message
     * @param string $request
     * @param string $response
     * @param Exception $previous
     */
    public function __construct(string $message, string $request, string $response, Exception $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $message), 500, $request, $response, $previous);
    }
}
