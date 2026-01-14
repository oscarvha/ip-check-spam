<?php

namespace Osd\IpCheckSpam\Domain\Contracts;

use Osd\IpCheckSpam\Domain\DTO\IpSpamInput;
use Osd\IpCheckSpam\Domain\Models\IpSpamAssessment;

interface IpSpamAnalyzer
{
    public function analyze(IpSpamInput $input): IpSpamAssessment;
}
