<?php

namespace Okolaa\TermiiPHP\Endpoints\Insight;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SearchPhoneNumberEndpoint extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $phoneNumber
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/api/check/dnd';
    }

    protected function defaultQuery(): array
    {
        return [
            'phone_number' => $this->phoneNumber
        ];
    }
}
