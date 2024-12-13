<?php

namespace Okolaa\TermiiPHP\Endpoints\Token;

use Okolaa\TermiiPHP\Data\Token\SendToken;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * The send token API allows businesses trigger one-time-passwords (OTP) across any available messaging channel on Termii.
 * One-time-passwords created are generated randomly and there's an option to set an expiry time.
 */
class SendTokenEndpoint extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(public readonly SendToken $sendToken)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/sms/otp/send';
    }

    protected function defaultBody(): array
    {
        return $this->sendToken->toRequestArray();
    }
}
