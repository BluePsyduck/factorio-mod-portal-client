<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Exception;

use Exception;

/**
 * The exception thrown when the response had an erroneous status code.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ErrorResponseException extends ClientException
{
    /**
     * The message template of the exception.
     */
    protected const MESSAGE = 'The request returned a status code %d: %s';

    /**
     * Initializes the exception.
     * @param string $message
     * @param int $statusCode
     * @param string $request
     * @param string $response
     * @param Exception $previous
     */
    public function __construct(
        string $message,
        int $statusCode,
        string $request,
        string $response,
        Exception $previous = null
    ) {
        parent::__construct(sprintf(self::MESSAGE, $statusCode, $message), $statusCode, $request, $response, $previous);
    }
}
