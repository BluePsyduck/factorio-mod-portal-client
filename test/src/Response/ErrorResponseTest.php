<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Response;

use BluePsyduck\FactorioModPortalClient\Response\ErrorResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ErrorResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Response\ErrorResponse
 */
class ErrorResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new ErrorResponse();

        $this->assertSame('', $response->getMessage());
    }

    /**
     * Tests the setting and getting the message.
     * @covers ::getMessage
     * @covers ::setMessage
     */
    public function testSetAndGetMessage(): void
    {
        $message = 'abc';
        $response = new ErrorResponse();

        $this->assertSame($response, $response->setMessage($message));
        $this->assertSame($message, $response->getMessage());
    }
}
