<?php

declare(strict_types=1);

namespace BluePsyduckTest\FactorioModPortalClient\Utils;

use BluePsyduck\FactorioModPortalClient\Entity\Mod;
use BluePsyduck\FactorioModPortalClient\Entity\Release;
use BluePsyduck\FactorioModPortalClient\Entity\Version;
use BluePsyduck\FactorioModPortalClient\Utils\ModUtils;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ModUtils class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \BluePsyduck\FactorioModPortalClient\Utils\ModUtils
 */
class ModUtilsTest extends TestCase
{
    /**
     * Tests the selectLatestRelease method.
     * @covers ::selectLatestRelease
     */
    public function testSelectLatestRelease(): void
    {
        $factorioVersion = new Version('1.2.3');

        $release1 = new Release();
        $release1->setVersion(new Version('4.5.6'));
        $release1->getInfoJson()->setFactorioVersion(new Version('1.2'));

        $release2 = new Release();
        $release2->setVersion(new Version('5.6.7'));
        $release2->getInfoJson()->setFactorioVersion(new Version('0.1')); // Not compatible

        $release3 = new Release();
        $release3->setVersion(new Version('5.6.7'));
        $release3->getInfoJson()->setFactorioVersion(new Version('1.2'));

        $release4 = new Release();
        $release4->setVersion(new Version('5.4.3')); // Lower than $release3
        $release4->getInfoJson()->setFactorioVersion(new Version('1.2'));

        $mod = new Mod();
        $mod->setReleases([$release1, $release2, $release3, $release4]);

        $result = ModUtils::selectLatestRelease($mod, $factorioVersion);

        $this->assertSame($release3, $result);
    }
}
