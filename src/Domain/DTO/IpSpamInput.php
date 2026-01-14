<?php

namespace Osd\IpCheckSpam\Domain\DTO;

/**
 *
 */
final class IpSpamInput
{
    /**
     * @param string $ip
     * @param int $asn
     * @param string $isp
     * @param string $organization
     * @param string $country
     * @param string|null $city
     * @param string $cidr
     */
    public function __construct(
        private string $ip,
        private int $asn,
        private string $isp,
        private string $organization,
        private string $country,
        private ?string $city,
        private string $cidr
    ) {}

    /**
     * @return string
     */
    public function ip(): string
    {
        return $this->ip;
    }

    /**
     * @return int
     */
    public function asn(): int
    {
        return $this->asn;
    }

    /**
     * @return string
     */
    public function isp(): string
    {
        return $this->isp;
    }

    /**
     * @return string
     */
    public function organization(): string
    {
        return $this->organization;
    }

    /**
     * @return string
     */
    public function country(): string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function city(): ?string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function cidr(): string
    {
        return $this->cidr;
    }
}
