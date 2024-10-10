<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\Command;

use Composer\Command;
use Composer\Factory;
use LeonHusmann\ComposerContribute\Composer\PackageFetcher;
use LeonHusmann\ComposerContribute\Composer\PackageSourceResolver;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function sprintf;

final class ContributeCommand extends Command\BaseCommand
{
    public function __construct(
        private readonly Factory $factory,
        private readonly PackageFetcher $packageFetcher,
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

        $io->write(sprintf('Running %s.', '1.0.0-alpha'));

        $composer = $this->factory->createComposer($io, Factory::getComposerFile());
        $resolver = new PackageSourceResolver($this->packageFetcher->fetchInstalledPackages($composer));

        foreach (
            [
                ...$composer->getPackage()->getRequires(),
                ...$composer->getPackage()->getDevRequires(),
            ] as $dependency
        ) {
            $source = $resolver->resolve($dependency->getTarget());
            if ($source === null) {
                continue;
            }

            $io->write(sprintf('%s', $source));
        }

        return SymfonyCommand::SUCCESS;
    }
}
