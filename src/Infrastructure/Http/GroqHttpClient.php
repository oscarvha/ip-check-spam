<?php

namespace Osd\IpCheckSpam\Infrastructure\Http;

use Osd\IpCheckSpam\Domain\Models\IpSpamAssessment;
use Osd\IpCheckSpam\Infrastructure\Mappers\IpSpamAssessmentMapper;

final readonly class GroqHttpClient
{
    public function __construct(
        private string $apiKey,
    ) {
    }

    /**
     * @throws \JsonException
     */
    public function consulting(string $prompt): IpSpamAssessment
    {

        $payload = [
            'model' => 'openai/gpt-oss-20b',
            'temperature' => 0.2,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ]
        ];

        $ch = curl_init('https://api.groq.com/openai/v1/chat/completions');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->apiKey,
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_THROW_ON_ERROR),
            CURLOPT_TIMEOUT => 30
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new RuntimeException('cURL error: ' . curl_error($ch));
        }

        curl_close($ch);


        return IpSpamAssessmentMapper::fromAiResponse(json_decode($response, true, 512, JSON_THROW_ON_ERROR)
         + ['model' => $payload['model'], 'provider' => 'Groq']
        );


    }
}
