<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Exception;

use BluePsyduck\FactorioModPortalClient\Exception\InvalidResponseException;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the InvalidResponseException class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Exception\InvalidResponseException
 */
class InvalidResponseExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $message = 'abc';
        $request = 'def';
        $response = 'ghi';
        $expectedMessage = 'The response was invalid and could not be parsed: abc';

        /* @var Exception&MockObject $previous */
        $previous = $this->createMock(Exception::class);

        $exception = new InvalidResponseException($message, $request, $response, $previous);

        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame(500, $exception->getCode());
        $this->assertSame($request, $exception->getRequest());
        $this->assertSame($response, $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
