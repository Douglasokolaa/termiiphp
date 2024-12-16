<?php

namespace Okolaa\TermiiPHP;

use Okolaa\TermiiPHP\Resources\Campaign\CampaignResource;
use Okolaa\TermiiPHP\Resources\InsightResource;
use Okolaa\TermiiPHP\Resources\MessagingResource;
use Okolaa\TermiiPHP\Resources\SenderIdResource;
use Okolaa\TermiiPHP\Resources\TokenResource;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Saloon\Traits\Plugins\HasTimeout;
use Throwable;

class TermiiConnector extends Connector
{
    use HasTimeout;
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    protected int $connectTimeout = 30;

    protected int $requestTimeout = 60;

    protected SenderIdResource $senderIdResource;

    protected MessagingResource $messagingResource;

    protected CampaignResource $campaignResource;

    protected TokenResource $tokenResource;

    private InsightResource $insightResource;

    public function __construct(
        protected readonly string $apiKey,
        protected readonly string $baseUrl
    ) {
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function senderIdApi(): SenderIdResource
    {
        return $this->senderIdResource ??= new SenderIdResource($this);
    }

    public function messagingApi(): MessagingResource
    {
        return $this->messagingResource ??= new MessagingResource($this);
    }

    public function campaignApi(): CampaignResource
    {
        return $this->campaignResource ??= new CampaignResource($this);
    }

    public function tokenApi(): TokenResource
    {
        return $this->tokenResource ??= new TokenResource($this);
    }

    public function insightApi(): InsightResource
    {
        return $this->insightResource ??= new InsightResource($this);
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
            'verify' => true,
        ];
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return new RequestException($response, previous: $senderException);
    }
}
