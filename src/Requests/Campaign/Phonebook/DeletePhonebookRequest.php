<?php

namespace Okolaa\TermiiPHP\Requests\Campaign\Phonebook;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeletePhonebookRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/phonebooks/$this->phonebookId";
    }

    public function __construct(private readonly string $phonebookId)
    {
    }
}