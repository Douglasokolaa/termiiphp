<?php

namespace Okolaa\TermiiPHP\Endpoints\Token;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * The email token API enables you to send one-time-passwords from your application through our email channel to an email address.
 * Only one-time-passwords (OTP) are allowed for now and these OTPs can not be verified using our Verify Token API.
 */
class EmailTokenEndpoint extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $emailAddress,
        private readonly string $code,
        private readonly string $emailConfigurationId,
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/email/otp/send';
    }

    protected function defaultBody(): array
    {
        return [
            'email_address' => $this->emailAddress,
            'code' => $this->code,
            'email_configuration_id' => $this->emailConfigurationId,
        ];
    }
}