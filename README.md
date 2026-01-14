# osd/ip-check-spam

Qualify whether an IP address is likely to be spam or abusive using AI-based analysis.

This package is **framework-agnostic**, designed to be used in any PHP project (Laravel, Symfony, legacy PHP, etc.) and follows a clean, DDD-inspired architecture.

It currently uses **Groq AI (GPT models)** to analyze IP metadata and return a structured spam risk assessment.

---

## Features

- AI-based IP spam risk analysis
- Residential vs datacenter classification
- Deterministic, structured output
- No framework dependencies
- No environment configuration required
- Explicit configuration via value objects
- Designed for clean integration into larger systems

---

## Requirements

- PHP ^8.1
- ext-curl
- A valid **Groq API key**

---

## Installation

```bash
composer require osd/ip-check-spam
```

## Basic Usage

```php
use Osd\IpCheckSpam\Bootstrap\IpCheckSpamFactory;
use Osd\IpCheckSpam\Domain\DTO\IpSpamInput;
use Osd\IpCheckSpam\Application\Config\IpSpamConfig;

// Build the input from your own IP/domain model
$input = new IpSpamInput(
    ip: 'IP_ADDRESS',
    asn: 12345,
    isp: 'ISP_NAME',
    organization: 'ORGANIZATION_NAME',
    country: 'COUNTRY_CODE',
    city: 'CITY_NAME',
    cidr: 'CIDR_RANGE'
);

// Explicit configuration (no env dependency)
$config = new IpSpamConfig(
    apiKey: 'YOUR_GROQ_API_KEY'
);

// Create analyzer
$analyze = IpCheckSpamFactory::create($config);

// Execute analysis
$assessment = $analyze->execute($input);

// Access results
$assessment->spamScore();
$assessment->confidence();
$assessment->type();
$assessment->explanation();
$assessment->explanationEs();
```

## Output Model

The analysis result is returned as an `IpSpamAssessment` value object.

| Field          | Type   | Description                          |
|---------------|--------|--------------------------------------|
| spamScore     | float  | Spam likelihood (0.0 – 1.0)           |
| confidence    | string | low, medium, high                    |
| type          | string | user or datacenter                   |
| explanation   | string | Technical explanation (EN)           |
| explanationEs | string | Technical explanation (ES)           |


## Architecture Overview

This package follows a clean, framework-agnostic architecture inspired by
DDD (Domain-Driven Design) and Hexagonal Architecture.

### Layers

- **Domain**
  - Pure business concepts
  - Immutable value objects (`IpSpamAssessment`)
  - DTOs (`IpSpamInput`)
  - Contracts (interfaces)

- **Application**
  - Use cases (`AnalyzeIpSpamRisk`)
  - Configuration objects (`IpSpamConfig`)
  - Orchestrates the analysis flow

- **Infrastructure**
  - External AI integration (Groq / GPT models)
  - HTTP clients
  - Prompt builders
  - Response mappers

- **Bootstrap**
  - Factory for assembling default implementations
  - No dependency on frameworks or containers

### Key Principles

- No framework dependency (Laravel / Symfony / etc.)
- No environment coupling (`.env` is not required)
- Explicit configuration via objects
- Immutable domain models
- Easy to replace AI providers or models
- Designed for reuse across multiple projects

This makes the package suitable for:
- Legacy PHP applications
- Modern PHP projects
- Microservices
- CLI tools
- Portfolio-grade architecture examples
