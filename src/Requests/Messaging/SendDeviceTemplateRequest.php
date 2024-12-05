<?php

namespace Okolaa\TermiiPHP\Requests\Messaging;

use Okolaa\TermiiPHP\Data\DeviceTemplate;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SendDeviceTemplateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly DeviceTemplate $deviceTemplate)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/send/template';
    }

    protected function defaultBody(): array
    {
        return $this->deviceTemplate->toRequestArray();
    }
}