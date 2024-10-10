<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\Command;

use Composer\Command;
use Composer\Factory;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function sprintf;

final class ContributeCommand extends Command\BaseCommand
{
    public function __construct(
        private Factory $factory,
    ) {
        parent::__construct('contribute');
    }

    protected function configure(): void
    {
        $this->setDescription('Find issues to contribute to');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = $this->getIO();

        $io->write([
            sprintf(
                'Running %s.',
                '1.0.0-alpha',
            ),
            '',
        ]);

        $composer = $this->factory->createComposer(
            $io,
            Factory::getComposerFile(),
        );

        $installedPackages = $composer->getRepositoryManager()->getLocalRepository()->getPackages();

        $io->write('Installed Dependencies and their Source URLs:');
        foreach ($installedPackages as $package) {
            $name = $package->getName();
            $io->write(sprintf('%s: %s', $name, $package->getSourceUrl()));
        }

        return SymfonyCommand::SUCCESS;
    }
}
