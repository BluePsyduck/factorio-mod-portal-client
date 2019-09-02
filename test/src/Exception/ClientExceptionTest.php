<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Exception;

use BluePsyduck\FactorioModPortalClient\Exception\ClientException;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ClientException class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Exception\ClientException
 */
class ClientExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     * @covers ::getRequest
     * @covers ::getResponse
     */
    public function testConstruct(): void
    {
        $message = 'abc';
        $code = 123;
        $request = 'def';
        $response = 'ghi';

        /* @var Exception&MockObject $previous */
        $previous = $this->createMock(Exception::class);

        $exception = new ClientException($message, $code, $request, $response, $previous);

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame($code, $exception->getCode());
        $this->assertSame($request, $exception->getRequest());
        $this->assertSame($response, $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
