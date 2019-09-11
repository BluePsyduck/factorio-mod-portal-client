<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Exception;

use BluePsyduck\FactorioModPortalClient\Exception\ConnectionException;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ConnectionException class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Exception\ConnectionException
 */
class ConnectionExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $message = 'abc';
        $request = 'def';
        $expectedMessage = 'Failed to connect to the server: abc';

        /* @var Exception&MockObject $previous */
        $previous = $this->createMock(Exception::class);

        $exception = new ConnectionException($message, $request, $previous);

        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame($request, $exception->getRequest());
        $this->assertSame('', $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
