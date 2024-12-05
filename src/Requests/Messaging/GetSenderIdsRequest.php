<?php

namespace Okolaa\TermiiPHP\Requests\Messaging;

use Okolaa\TermiiPHP\Data\PaginatedData;
use Okolaa\TermiiPHP\Data\SenderId;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetSenderIdsRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(protected int $page)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/sender-id';
    }

    protected function defaultQuery(): array
    {
        return [
            'page' => $this->page
        ];
    }

    /**
     * @param Response $response
     * @return PaginatedData<SenderId>
     */
    public function createDtoFromResponse(Response $response): PaginatedData
    {
        return PaginatedData::fromResponse($response, SenderId::class);
    }
}