<?php

namespace Okolaa\TermiiPHP\Requests\Campaign\Phonebook;

use Okolaa\TermiiPHP\Data\Phonebook;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdatePhonebookRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/phonebooks/{$this->phonebook->id}";
    }

    public function __construct(private readonly Phonebook $phonebook)
    {
    }

    protected function defaultBody(): array
    {
        return $this->phonebook->toRequestArray();
    }
}