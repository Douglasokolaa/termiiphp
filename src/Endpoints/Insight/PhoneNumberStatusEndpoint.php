<?php

namespace Okolaa\TermiiPHP\Endpoints\Insight;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class PhoneNumberStatusEndpoint extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $phoneNumber,
        protected readonly string $countryCode = 'NG'
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/api/insight/number/query';
    }

    protected function defaultQuery(): array
    {
        return [
            'phone_number' => $this->phoneNumber,
            'country_code' => $this->countryCode
        ];
    }
}
