<?php

namespace Osd\IpCheckSpam\Application\Config;

final readonly class IpSpamConfig
{
    /**
     * @param string $apiKey
     */
    public function __construct(
        private string $apiKey,
    )
    {
        if ($this->apiKey === '') {
            throw new \InvalidArgumentException('API key cannot be empty');
        }
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
