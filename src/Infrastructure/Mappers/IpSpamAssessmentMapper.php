<?php

namespace Osd\IpCheckSpam\Infrastructure\Mappers;

use Osd\IpCheckSpam\Domain\Models\IpSpamAssessment;
use RuntimeException;

final class IpSpamAssessmentMapper
{
    /**
     * @throws \JsonException
     */
    public static function fromAiResponse(array $response): IpSpamAssessment
    {

        if (!isset( $response['choices'][0]['message']['content'])) {

            throw new RuntimeException('Wrong Response');
        }

        $data = $response['choices'][0]['message']['content'];

        $result = [];

        foreach (explode("\n", $data) as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            [$key, $value] = array_map('trim', explode(':', $line, 2));

            if (is_numeric($value)) {
                $value = (float) $value;
            }

            $result[$key] = $value;
        }

        return new IpSpamAssessment(
            $result['spam_score'],
            $result['confidence'],
            $result['type'],
            $result['explanation'],
            $result['explanation_es'],
            $response['model'],
            $response['provider']
        );
    }
}
