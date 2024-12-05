<?php

namespace Okolaa\TermiiPHP\Requests\Campaign;

use Okolaa\TermiiPHP\Data\CampaignHistory;
use Okolaa\TermiiPHP\Data\PaginatedData;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetCampaignHistoryRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(private readonly string $campaignId, private readonly int $page)
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
     * @return PaginatedData<CampaignHistory>
     */
    public function createDtoFromResponse(Response $response): PaginatedData
    {
        return PaginatedData::fromResponse($response, CampaignHistory::class);
    }
}