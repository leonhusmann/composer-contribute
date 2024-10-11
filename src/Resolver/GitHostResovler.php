<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\Resolver;

use LeonHusmann\ComposerContribute\GithubApi\RepositoryMetadata;
use RuntimeException;

use function stripos;

class GitHostResovler
{
    public function resolve(string $repoUrl): GitHost
    {
        if ($this->isGitHubUrl($repoUrl)) {
            return new RepositoryMetadata();
        }

        throw new RuntimeException('Git host can not be resolved', 1728651729564);
    }

    private function isGitHubUrl(string $repoUrl): bool
    {
        return stripos($repoUrl, 'github.com') !== false;
    }
}
