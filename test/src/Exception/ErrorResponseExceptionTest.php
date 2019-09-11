<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Exception;

use BluePsyduck\FactorioModPortalClient\Exception\ErrorResponseException;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ErrorResponseException class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Exception\ErrorResponseException
 */
class ErrorResponseExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $statusCode = 42;
        $message = 'abc';
        $request = 'def';
        $response = 'ghi';
        $expectedMessage = 'The request returned a status code 42: abc';

        /* @var Exception&MockObject $previous */
        $previous = $this->createMock(Exception::class);

        $exception = new ErrorResponseException($message, $statusCode, $request, $response, $previous);

        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame($statusCode, $exception->getCode());
        $this->assertSame($request, $exception->getRequest());
        $this->assertSame($response, $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
