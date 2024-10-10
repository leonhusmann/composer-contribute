<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\Composer;

use Composer\Composer;
use Composer\Package\BasePackage;

use function array_combine;
use function array_map;

final class PackageFetcher
{
    /** @return array<string, BasePackage> */
    public function fetchInstalledPackages(Composer $composer): array
    {
        $installedPackages = $composer->getRepositoryManager()->getLocalRepository()->getPackages();

        return array_combine(
            array_map(
                static fn ($package): string => $package->getName(),
                $installedPackages,
            ),
            $installedPackages,
        );
    }
}
