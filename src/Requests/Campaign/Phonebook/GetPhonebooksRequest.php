<?php

namespace Okolaa\TermiiPHP\Requests\Campaign\Phonebook;

use Okolaa\TermiiPHP\Data\PaginatedData;
use Okolaa\TermiiPHP\Data\Phonebook;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetPhonebooksRequest extends Request
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
     * @return PaginatedData<Phonebook>
     */
    public function createDtoFromResponse(Response $response): PaginatedData
    {
        return PaginatedData::fromResponse($response, Phonebook::class);
    }
}