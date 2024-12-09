<?php

namespace Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook;

use Psr\Http\Message\StreamInterface;
use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class ImportContactEndpoint extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    /**
     * @param string $phonebookId
     * @param string $countryCode
     * @param StreamInterface|string|resource|int $file
     */
    public function __construct(
        private readonly string $phonebookId,
        private readonly string $countryCode,
        private readonly mixed  $file
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/phonebooks/contacts/upload';
    }

    protected function defaultBody(): array
    {
        return [
            new MultipartValue('file', $this->file),
            new MultipartValue('contact', json_encode([
                'pid' => $this->phonebookId,
                'country_code' => $this->countryCode,
            ])),
        ];
    }
}