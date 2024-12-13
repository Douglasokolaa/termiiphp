<?php

namespace Okolaa\TermiiPHP\Data;

use Okolaa\TermiiPHP\Data\Contracts\ConvertsArrayToDTO;
use Okolaa\TermiiPHP\Data\Contracts\ConvertsDtoToRequestArray;

class Phonebook implements ConvertsArrayToDTO, ConvertsDtoToRequestArray
{
    public function __construct(
        public readonly string  $name,
        public readonly string  $description,
        public readonly int     $totalContacts = 0,
        public readonly ?string $id = null,
        public readonly ?string $created = null,
        public readonly ?string $updated = null,
    ) {
    }

    public static function fromArray(array $data): Phonebook
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? '',
            totalContacts: $data['total_number_of_contacts'],
            id: $data['id'],
            created: $data['date_created'],
            updated: $data['last_updated']
        );
    }

    public function toRequestArray(): array
    {
        return [
            'phonebook_name' => $this->name,
            'description'    => $this->description,
        ];
    }
}
