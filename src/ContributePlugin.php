<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute;

use Composer\Composer;
use Composer\Factory;
use Composer\IO;
use Composer\Plugin;
use LeonHusmann\ComposerContribute\Composer\PackageFetcher;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

final class ContributePlugin implements Plugin\Capability\CommandProvider, Plugin\Capable, Plugin\PluginInterface
{
    public function activate(Composer $composer, IO\IOInterface $io): void
    {
    }

    public function deactivate(Composer $composer, IO\IOInterface $io): void
    {
    }

    public function uninstall(Composer $composer, IO\IOInterface $io): void
    {
    }

    /** @return array<class-string, class-string> */
    public function getCapabilities(): array
    {
        return [
            Plugin\Capability\CommandProvider::class => self::class,
        ];
    }

    /** @return list<SymfonyCommand> */
    public function getCommands(): array
    {
        return [
            new Command\ContributeCommand(
                new Factory(),
                new PackageFetcher(),
            ),
        ];
    }
}
