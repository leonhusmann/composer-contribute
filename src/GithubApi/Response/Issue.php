<?php

declare(strict_types=1);

namespace LeonHusmann\ComposerContribute\GithubApi\Response;

class Issue
{
    /** @param string[] $reactions */
    public function __construct(
        private string $url,
        private string $repositoryUrl,
        private string $labelsUrl,
        private string $commentsUrl,
        private string $eventsUrl,
        private string $htmlUrl,
        private int $id,
        private string $nodeId,
        private int $number,
        private string $title,
        private string $state,
        private bool $locked,
        private string $createdAt,
        private string $updatedAt,
        private string|null $closedAt,
        private string $authorAssociation,
        private string|null $activeLockReason,
        private string $body,
        private array $reactions,
        private string $timelineUrl,
        private string|null $performedViaGithubApp,
        private string|null $stateReason,
        private float $score,
    ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getRepositoryUrl(): string
    {
        return $this->repositoryUrl;
    }

    public function getLabelsUrl(): string
    {
        return $this->labelsUrl;
    }

    public function getCommentsUrl(): string
    {
        return $this->commentsUrl;
    }

    public function getEventsUrl(): string
    {
        return $this->eventsUrl;
    }

    public function getHtmlUrl(): string
    {
        return $this->htmlUrl;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNodeId(): string
    {
        return $this->nodeId;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getLocked(): bool
    {
        return $this->locked;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getClosedAt(): string|null
    {
        return $this->closedAt;
    }

    public function getAuthorAssociation(): string
    {
        return $this->authorAssociation;
    }

    public function getActiveLockReason(): string|null
    {
        return $this->activeLockReason;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getReactions(): string
    {
        return $this->reactions;
    }

    public function getTimelineUrl(): string
    {
        return $this->timelineUrl;
    }

    public function getPerformedViaGithubApp(): string
    {
        return $this->performedViaGithubApp;
    }

    public function getStateReason(): string
    {
        return $this->stateReason;
    }

    public function getScore(): string
    {
        return $this->score;
    }
}
