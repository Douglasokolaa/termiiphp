<?php

namespace Okolaa\TermiiPHP\Data;

use Okolaa\TermiiPHP\Data\Contracts\ConvertsArrayToDTO;
use Okolaa\TermiiPHP\Data\Contracts\ConvertsDtoToRequestArray;

class SenderId implements ConvertsArrayToDTO, ConvertsDtoToRequestArray
{
    public function __construct(
        public readonly string  $id,
        public readonly ?string $company,
        public readonly ?string $useCase,
        public readonly ?string $country = null,
        public readonly ?string $status = null,
    ) {
    }

    public static function fromArray(array $data): SenderId
    {
        return new self(
            id: $data['sender_id'],
            company: $data['company'],
            useCase: $data['usecase'],
            country: $data['country'],
            status: $data['status']
        );
    }

    public function toRequestArray(): array
    {
        return [
            'sender_id' => $this->id,
            'usecase'   => $this->useCase,
            'company'   => $this->company
        ];
    }
}
