<?php
namespace Osd\IpCheckSpam\Bootstrap;

use Osd\IpCheckSpam\Application\AnalyzeIpSpamRisk;
use Osd\IpCheckSpam\Application\Config\IpSpamConfig;
use Osd\IpCheckSpam\Infrastructure\Ai\GroqIpSpamAnalyzer;
use Osd\IpCheckSpam\Infrastructure\Http\GroqHttpClient;
use Osd\IpCheckSpam\Infrastructure\Prompt\IpSpamPromptBuilder;

final class IpCheckSpamFactory
{
    public static function create(IpSpamConfig $config): AnalyzeIpSpamRisk
    {
        return new AnalyzeIpSpamRisk(
            new GroqIpSpamAnalyzer(
                new GroqHttpClient(
                    apiKey: $config->getApiKey(),
                ),
                new IpSpamPromptBuilder()
            )
        );
    }
}
