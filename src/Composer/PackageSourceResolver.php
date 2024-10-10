<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\Composer;

use Composer\Package\BasePackage;

final readonly class PackageSourceResolver
{
    public function __construct(
        /** @var array<string, BasePackage> $installedPackages */
        private array $installedPackages,
    ) {
    }

    public function resolve(string $target): string|null
    {
        return ($this->installedPackages[$target] ?? null)?->getSourceUrl();
    }
}
