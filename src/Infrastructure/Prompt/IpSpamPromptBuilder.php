<?php

namespace Osd\IpCheckSpam\Infrastructure\Prompt;

use Osd\IpCheckSpam\Domain\DTO\IpSpamInput;

final class IpSpamPromptBuilder
{
    /**
     * @param IpSpamInput $input
     * @return string
     */
    public function build(IpSpamInput $input): string
    {
        return <<<PROMPT
        You are an IP risk analysis engine.

        Your task is to evaluate an IP address and provide:
        1) a spam risk assessment
        2) a classification indicating whether the IP belongs to a datacenter or an end user

        Return ONLY the following fields:
        - spam_score: number between 0 and 1
        - confidence: low | medium | high
        - explanation: short technical explanation in English
        - explanation_es: short technical explanation in Spanish
        - score_user: number between 0 and 1
        - type: datacenter | user

        Interpretation rules:
        - spam_score close to 1 means higher likelihood of spam risk
        - score close to 1 means datacenter or hosting IP
        - score close to 0 means residential or mobile user IP
        - Large CIDR ranges (e.g. /16 or larger) usually indicate residential ISP networks and reduce spam risk
        - Small CIDR ranges (/24 or smaller) increase datacenter or abuse likelihood
        - Hosting, cloud, VPS providers indicate datacenter
        - Large consumer ISPs usually indicate user IPs
        - RIPE NCC European consumer ISPs tend to have lower abuse rates
        - Mobile or dynamic IPs are user IPs but reduce confidence

        IP data:
        - IP: {$input->ip()}
        - ASN: {$input->asn()}
        - ISP: {$input->isp()}
        - Organization: {$input->organization()}
        - Country: {$input->country()}
        - City: {$input->city()}
        - CIDR: {$input->cidr()}

        Do not include any text outside these fields.
    PROMPT;
    }
}
