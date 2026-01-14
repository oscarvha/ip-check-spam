<?php


use Osd\IpCheckSpam\Domain\Contracts\IpSpamAnalyzer;
use Osd\IpCheckSpam\Domain\DTO\IpSpamInput;
use Osd\IpCheckSpam\Domain\Models\IpSpamAssessment;

final readonly class AnalyzeIpSpamRisk
{
    public function __construct(
        private IpSpamAnalyzer $analyzer
    ) {}

    public function execute(IpSpamInput $input): IpSpamAssessment
    {
        return $this->analyzer->analyze($input);
    }
}
