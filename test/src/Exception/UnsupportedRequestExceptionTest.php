<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Exception;

use BluePsyduck\FactorioModPortalClient\Exception\UnsupportedRequestException;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the UnsupportedRequestException class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Exception\UnsupportedRequestException
 */
class UnsupportedRequestExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $requestClass = 'abc';
        $expectedMessage = 'The request abc cannot be matched by any endpoint.';

        /* @var Exception&MockObject $previous */
        $previous = $this->createMock(Exception::class);

        $exception = new UnsupportedRequestException($requestClass, $previous);

        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame('', $exception->getRequest());
        $this->assertSame('', $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
