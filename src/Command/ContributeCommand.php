<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\Command;

use Composer\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ContributeCommand extends Command\BaseCommand
{
    public function __construct()
    {
        parent::__construct('contribute');
    }

    protected function configure(): void
    {
        $this->setDescription('Find issues to contribute to');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->writeln('Hello world');

        return SymfonyCommand::SUCCESS;
    }
}
