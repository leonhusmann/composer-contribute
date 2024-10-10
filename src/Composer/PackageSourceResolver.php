<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\Composer;

use Composer\Composer;
use Composer\Package\BasePackage;

final readonly class PackageSourceResolver
{
    public function __construct(
        private Composer $composer,
        /** @var array<string, BasePackage> $installedPackages */
        private array $installedPackages,
    ) {
    }

    public function resolve(string $target): BasePackage|null
    {
        if (! isset($this->installedPackages[$target])) {
            return null;
        }

        return $this->composer->getRepositoryManager()->findPackage($target, '*');
    }
}
