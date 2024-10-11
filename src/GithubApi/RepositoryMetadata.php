<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\GithubApi;

use Composer\Package\BasePackage;
use LeonHusmann\ComposerContribute\GithubApi\Response\IssueCollection;
use LeonHusmann\ComposerContribute\Resolver\GitHost;
use RuntimeException;

use function count;
use function curl_close;
use function curl_errno;
use function curl_exec;
use function curl_init;
use function curl_setopt_array;
use function explode;

use const CURLOPT_FOLLOWLOCATION;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_TIMEOUT;
use const CURLOPT_URL;

class RepositoryMetadata implements GitHost
{
    public function fetchIssues(BasePackage $package): IssueCollection
    {
        $ch = curl_init();

        $packageName = $this->extractRepoName($package);

        // Set the cURL options
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.github.com/search/issues?q=repo:' . $packageName . '+state:open',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTPHEADER => [
                'Accept: application/vnd.github+json',
                'User-Agent: Composer-Contributors',
            ],
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new RuntimeException('Curl request failed with code ' . curl_errno($ch));
        }

        curl_close($ch);

        return IssueCollection::fromResponse($response);
    }

    public function extractRepoName(BasePackage $package): string|null
    {
        $packageName = $package->getSourceUrl() ?? '';
        $packageName = explode('/', $packageName);
        $packageName = $packageName[count($packageName) - 2] . '/' . $packageName[count($packageName) - 1];
        $packageName = explode('.', $packageName);

        return $packageName[0];
    }
}
