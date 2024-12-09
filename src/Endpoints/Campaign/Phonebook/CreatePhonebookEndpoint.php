<?php

namespace Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook;

use Okolaa\TermiiPHP\Data\Phonebook;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreatePhonebookEndpoint extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/phonebooks';
    }

    public function __construct(private readonly Phonebook $phonebook)
    {
    }

    protected function defaultBody(): array
    {
        return $this->phonebook->toRequestArray();
    }
}