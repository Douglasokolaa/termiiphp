<?php

namespace Okolaa\TermiiPHP\Endpoints\Token;

use Okolaa\TermiiPHP\Data\Token\InAppToken;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * This API returns OTP codes in JSON format which can be used within any web or mobile app.
 * Tokens are numeric or alpha-numeric codes generated to authenticate login requests and verify customer transactions.
 */
class InAppTokenEndpoint extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(public readonly InAppToken $inAppToken)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/sms/otp/generate';
    }

    protected function defaultBody(): array
    {
        return $this->inAppToken->toRequestArray();
    }
}