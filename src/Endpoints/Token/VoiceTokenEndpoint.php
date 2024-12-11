<?php

namespace Okolaa\TermiiPHP\Endpoints\Token;

use Okolaa\TermiiPHP\Data\Token\VoiceToken;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * The voice token API enables you to generate and trigger one-time passwords (OTP) through the voice channel to a phone number.
 * OTPs are generated and sent to the phone number and can only be verified using our Verify Token API https://developers.termii.com/verify-token .
 */
class VoiceTokenEndpoint extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(public readonly VoiceToken $voiceToken)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/sms/otp/send/voice';
    }

    protected function defaultBody(): array
    {
        return $this->voiceToken->toRequestArray();
    }
}