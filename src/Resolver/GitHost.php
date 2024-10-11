<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\Resolver;

use Composer\Package\BasePackage;
use LeonHusmann\ComposerContribute\GithubApi\Response\IssueCollection;

interface GitHost
{
    public function fetchIssues(BasePackage $package): IssueCollection;
}
