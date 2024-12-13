<?php

namespace Okolaa\TermiiPHP\Endpoints\Insight;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class HistoryEndpoint extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly ?string $messageId = null
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/api/sms/inbox';
    }

    protected function defaultQuery(): array
    {
        return [
            'message_id' => $this->messageId
        ];
    }
}
