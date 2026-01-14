<?php

namespace Osd\IpCheckSpam\Domain\Models;

/**
 *
 */
final readonly class IpSpamAssessment
{
    /**
     * @param float $spamScore
     * @param string $confidence
     * @param string $type
     * @param string $explanation
     * @param string $explanationEs
     * @param string $model
     * @param string $provider
     */
    public function __construct(
        private float $spamScore,
        private string $confidence,
        private string $type,
        private string $explanation,
        private string $explanationEs,
        private string $model,
        private string $provider,
    ) {
    }

    /**
     * @return float
     */
    public function spamScore(): float
    {
        return $this->spamScore;
    }

    /**
     * @return string
     */
    public function confidence(): string
    {
        return $this->confidence;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function explanation(): string
    {
        return $this->explanation;
    }

    /**
     * @return string
     */
    public function explanationEs(): string
    {
        return $this->explanationEs;
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function provider(): string
    {
        return $this->provider;
    }

}
