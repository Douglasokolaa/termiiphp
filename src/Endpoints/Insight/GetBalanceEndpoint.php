<?php

namespace Okolaa\TermiiPHP\Endpoints\Insight;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetBalanceEndpoint extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/get-balance';
    }
}
