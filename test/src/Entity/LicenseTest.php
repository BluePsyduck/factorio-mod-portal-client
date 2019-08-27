<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Entity\License;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the License class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Entity\License
 */
class LicenseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $entity = new License();

        $this->assertSame('', $entity->getName());
        $this->assertSame('', $entity->getUrl());
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $entity = new License();

        $this->assertSame($entity, $entity->setName($name));
        $this->assertSame($name, $entity->getName());
    }

    /**
     * Tests the setting and getting the url.
     * @covers ::getUrl
     * @covers ::setUrl
     */
    public function testSetAndGetUrl(): void
    {
        $url = 'https://www.example.com/';
        $entity = new License();

        $this->assertSame($entity, $entity->setUrl($url));
        $this->assertSame($url, $entity->getUrl());
    }
}
