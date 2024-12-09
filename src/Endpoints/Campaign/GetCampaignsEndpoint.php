<?php

namespace Okolaa\TermiiPHP\Endpoints\Campaign;

use Okolaa\TermiiPHP\Data\Campaign;
use Okolaa\TermiiPHP\Data\PaginatedData;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetCampaignsEndpoint extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(private readonly int $page)
    {
    }

    protected function defaultQuery(): array
    {
        return [
            'page' => $this->page,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/api/phonebooks';
    }

    /**
     * @param Response $response
     * @return PaginatedData<Campaign>
     */
    public function createDtoFromResponse(Response $response): PaginatedData
    {
        return PaginatedData::fromResponse($response, Campaign::class);
    }
}