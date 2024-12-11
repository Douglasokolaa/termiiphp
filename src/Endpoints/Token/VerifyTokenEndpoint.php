<?php

namespace Okolaa\TermiiPHP\Endpoints\Token;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Verify token API, checks tokens sent to customers and returns a response confirming the status of the token.
 * A token can either be confirmed as verified or expired based on the timer set for the token.
 */
class VerifyTokenEndpoint extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $pinId,
        private readonly string $pin,
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/sms/otp/verify';
    }

    protected function defaultBody(): array
    {
        return [
            'pin_id' => $this->pinId,
            'pin' => $this->pin,
        ];
    }
}