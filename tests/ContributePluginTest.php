<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\Tests;

use LeonHusmann\ComposerContribute\Command\ContributeCommand;
use LeonHusmann\ComposerContribute\ContributePlugin;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ContributePlugin::class)]
class ContributePluginTest extends TestCase
{
    public function testGetCommands(): void
    {
        $sut = new ContributePlugin();

        $commands = $sut->getCommands();

        self::assertCount(1, $commands);
        self::assertInstanceOf(ContributeCommand::class, $commands[array_key_first($commands)]);
    }
}