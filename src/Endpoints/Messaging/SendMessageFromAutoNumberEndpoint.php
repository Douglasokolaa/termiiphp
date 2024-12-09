<?php

namespace Okolaa\TermiiPHP\Endpoints\Messaging;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * This API allows businesses send messages to customers using
 * Termii's auto-generated messaging numbers that adapt to customers location.
 */
class SendMessageFromAutoNumberEndpoint extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly string $to, private readonly string $message)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/sms/number/send';
    }

    protected function defaultBody(): array
    {
        return [
            'to' => $this->to,
            'message' => $this->message,
        ];
    }
}