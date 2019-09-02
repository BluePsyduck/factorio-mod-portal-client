<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient;

use BluePsyduck\FactorioModPortalClient\ConfigProvider;
use BluePsyduck\FactorioModPortalClient\Constant\ConfigKey;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ConfigProvider class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\ConfigProvider
 */
class ConfigProviderTest extends TestCase
{
    /**
     * Tests the invoking.
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        $configProvider = new ConfigProvider();
        $result = $configProvider();

        $this->assertArrayHasKey('dependencies', $result);
        $this->assertArrayHasKey('factories', $result['dependencies']);

        $this->assertArrayHasKey(ConfigKey::MAIN, $result);
        $this->assertArrayHasKey(ConfigKey::ENDPOINTS, $result[ConfigKey::MAIN]);
    }
}
