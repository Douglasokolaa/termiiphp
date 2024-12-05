<?php

namespace Okolaa\TermiiPHP;

use Okolaa\TermiiPHP\Resources\Campaign\CampaignResource;
use Okolaa\TermiiPHP\Resources\MessagingResource;
use Okolaa\TermiiPHP\Resources\SenderIdResource;
use Okolaa\TermiiPHP\Resources\TokenResource;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Saloon\Traits\Plugins\HasTimeout;

class Termii extends Connector
{
    use HasTimeout;
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    protected int $connectTimeout = 30;

    protected int $requestTimeout = 60;

    public function __construct(
        protected readonly string $apiKey,
        protected readonly string $baseUrl = 'https://v3.api.termii.com'
    )
    {
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    protected function defaultAuth(): TermiiAuthenticator
    {
        return new TermiiAuthenticator($this->apiKey);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultConfig(): array
    {
        return [
            'verify' => false,
        ];
    }

    public function senderIdApi(): SenderIdResource
    {
        return new SenderIdResource($this);
    }

    public function messagingApi(): MessagingResource
    {
        return new MessagingResource($this);
    }

    public function campaignApi(): CampaignResource
    {
        return new CampaignResource($this);
    }

    public function tokenApi(): TokenResource
    {
        return new TokenResource($this);
    }
}