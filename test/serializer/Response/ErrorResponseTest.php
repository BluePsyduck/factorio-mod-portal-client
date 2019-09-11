<?php

declare(strict_types=1);

namespace BluePsyduckTestSerializer\FactorioModPortalClient\Response;

use BluePsyduck\FactorioModPortalClient\Response\ErrorResponse;
use BluePsyduckTestAsset\FactorioModPortalClient\SerializerTestCase;

/**
 * The serializer test for the ErrorResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ErrorResponseTest extends SerializerTestCase
{
    /**
     * Tests the deserializing.
     */
    public function testDeserialize(): void
    {
        $data = [
            'message' => 'abc',
        ];

        $expectedObject = new ErrorResponse();
        $expectedObject->setMessage('abc');

        $this->assertDeserializedObject($data, $expectedObject);
    }
}
