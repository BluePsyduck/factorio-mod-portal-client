<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Exception;

use Exception;

/**
 * The exception thrown when an unsupported request has been encountered by the client.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class UnsupportedRequestException extends ClientException
{
    /**
     * The message template of the exception.
     */
    protected const MESSAGE = 'The request %s cannot be matched by any endpoint.';

    /**
     * Initializes the exception.
     * @param string $requestClass
     * @param Exception $previous
     */
    public function __construct(string $requestClass, Exception $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $requestClass), 0, '', '', $previous);
    }
}
