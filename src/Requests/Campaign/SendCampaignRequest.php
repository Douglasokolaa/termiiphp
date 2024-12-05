<?php

namespace Okolaa\TermiiPHP\Requests\Campaign;

use Okolaa\TermiiPHP\Data\Campaign;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SendCampaignRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/sms/campaigns/send';
    }

    public function __construct(private readonly Campaign $campaign)
    {
    }

    protected function defaultBody(): array
    {
        return $this->campaign->toRequestArray();
    }
}