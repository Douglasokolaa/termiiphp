<?php

namespace Okolaa\TermiiPHP\Endpoints\Token;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * The voice call API enables you to send messages from your application through our voice channel to a phone number.
 * Only one-time-passwords (OTP) are allowed for now and these OTPs can not be verified using our Verify Token API.
 */
class VoiceCallEndpoint extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $phoneNumber,
        private readonly string $code
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/sms/otp/call';
    }

    protected function defaultBody(): array
    {
        return [
            'phone_number' => $this->phoneNumber,
            'code' => $this->code,
        ];
    }
}