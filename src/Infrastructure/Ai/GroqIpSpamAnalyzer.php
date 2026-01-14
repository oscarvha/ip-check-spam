<?php

namespace Osd\IpCheckSpam\Infrastructure\Ai;

use Osd\IpCheckSpam\Domain\Contracts\IpSpamAnalyzer;
use Osd\IpCheckSpam\Domain\DTO\IpSpamInput;
use Osd\IpCheckSpam\Domain\Models\IpSpamAssessment;
use Osd\IpCheckSpam\Infrastructure\Http\GroqHttpClient;
use Osd\IpCheckSpam\Infrastructure\Mappers\IpSpamAssessmentMapper;
use Osd\IpCheckSpam\Infrastructure\Prompt\IpSpamPromptBuilder;

final class GroqIpSpamAnalyzer implements IpSpamAnalyzer
{
    public function __construct(
        private GroqHttpClient $client,
        private IpSpamPromptBuilder $promptBuilder
    ) {}

    /**
     * @throws \JsonException
     */
    public function analyze(IpSpamInput $input): IpSpamAssessment
    {
        $prompt = $this->promptBuilder->build($input);

        return $this->client->consulting($prompt);
    }
}
