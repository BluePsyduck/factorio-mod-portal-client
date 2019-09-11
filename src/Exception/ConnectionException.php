<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Exception;

use Exception;

/**
 * The exception thrown when the connection to the server could not be established or timed out.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ConnectionException extends ClientException
{
    /**
     * The message template of the exception.
     */
    protected const MESSAGE = 'Failed to connect to the server: %s';

    /**
     * Initializes the exception.
     * @param string $message
     * @param string $request
     * @param Exception $previous
     */
    public function __construct(string $message, string $request, Exception $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $message), 0, $request, '', $previous);
    }
}
