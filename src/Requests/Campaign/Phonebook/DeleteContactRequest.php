<?php

namespace Okolaa\TermiiPHP\Requests\Campaign\Phonebook;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteContactRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/phonebook/contact/$this->contactId";
    }

    public function __construct(private readonly string $contactId)
    {
    }
}