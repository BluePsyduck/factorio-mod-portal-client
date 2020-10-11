<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Utils;

use BluePsyduck\FactorioModPortalClient\Entity\Mod;
use BluePsyduck\FactorioModPortalClient\Entity\Release;
use BluePsyduck\FactorioModPortalClient\Entity\Version;

/**
 * The utility class for the mods and releases.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModUtils
{
    /**
     * Selects the latest release which is compatible with the specified game version.
     * @param Mod $mod
     * @param Version|null $requiredGameVersion The required game version, or null to not check the game version at all.
     * @return Release|null
     */
    public static function selectLatestRelease(Mod $mod, ?Version $requiredGameVersion = null): ?Release
    {
        /* @var Release|null $latestRelease */
        $latestRelease = null;
        /* @var Version|null $latestReleaseVersion */
        $latestReleaseVersion = null;

        foreach ($mod->getReleases() as $release) {
            if (
                $requiredGameVersion !== null
                && !$requiredGameVersion->isCompatibleTo($release->getInfoJson()->getFactorioVersion())
            ) {
                continue;
            }

            if ($latestReleaseVersion === null || $release->getVersion()->compareTo($latestReleaseVersion) > 0) {
                $latestRelease = $release;
                $latestReleaseVersion = $release->getVersion();
            }
        }

        return $latestRelease;
    }
}
