<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\GithubApi\Response;

use Countable;

use function count;
use function json_decode;

use const JSON_THROW_ON_ERROR;

class IssueCollection implements Countable
{
    /** @param Issue[] $issues */
    private function __construct(
        private readonly array $issues,
    ) {
    }

    public static function fromResponse(string $response): self
    {
        $decodedResponse = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        $issueList = [];
        foreach ($decodedResponse['items'] as $item) {
            $issueList[] = new Issue(
                $item['url'],
                $item['repository_url'],
                $item['labels_url'],
                $item['comments_url'],
                $item['events_url'],
                $item['html_url'],
                $item['id'],
                $item['node_id'],
                $item['number'],
                $item['title'],
                $item['state'],
                $item['locked'],
                $item['created_at'],
                $item['updated_at'],
                $item['closed_at'],
                $item['author_association'],
                $item['active_lock_reason'],
                $item['body'] ?? '',
                $item['reactions'] ?? [],
                $item['timeline_url'],
                $item['performed_via_github_app'],
                $item['state_reason'],
                $item['score'],
            );
        }

        return new self($issueList);
    }

    /** @return Issue[] */
    public function getIssues(): array
    {
        return $this->issues;
    }

    public function count(): int
    {
        return count($this->issues);
    }
}
