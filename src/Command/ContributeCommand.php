<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\Command;

use Composer\Command;
use Composer\Factory;
use Composer\Package\BasePackage;
use LeonHusmann\ComposerContribute\Composer\PackageFetcher;
use LeonHusmann\ComposerContribute\Composer\PackageSourceResolver;
use LeonHusmann\ComposerContribute\Resolver\GitHostResovler;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function sprintf;

final class ContributeCommand extends Command\BaseCommand
{
    public function __construct(
        private readonly Factory $factory,
        private readonly PackageFetcher $packageFetcher,
        private readonly GitHostResovler $gitHostResovler,
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
        $resolver = new PackageSourceResolver(
            $composer,
            $this->packageFetcher->fetchInstalledPackages($composer),
        );

        $table = new Table($output);
        $table->setHeaders(['id', 'name', 'Issues']);

        $id = 0;
        foreach (
            [
                ...$composer->getPackage()->getRequires(),
                ...$composer->getPackage()->getDevRequires(),
            ] as $dependency
        ) {
            $basePackage = $resolver->resolve($dependency->getTarget());
            if ($basePackage === null) {
                continue;
            }

            $gitHost = $this->gitHostResovler->resolve($basePackage->getSourceUrl());
            $issues  = $gitHost->fetchIssues($basePackage);
            $table->addRow([++$id, $basePackage->getPrettyName(), $issues->count()]);
        }

        $table->render();

        return SymfonyCommand::SUCCESS;
    }
}
