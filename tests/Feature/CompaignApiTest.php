<?php

use Saloon\Traits\Body\HasJsonBody;
use function Pest\Faker\fake;

test('it can get phonebooks', closure: function () {
    expect(\Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\GetPhonebooksEndpoint::class)
        ->toSendGetRequest()
        ->toUse(\Saloon\Traits\Request\CreatesDtoFromResponse::class)
        ->and($response = createTestConnector()
            ->campaignApi()
            ->phoneBook()
            ->get()
        )
        ->toBeInstanceOf(\Saloon\Http\Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->dto())->toBeInstanceOf(\Okolaa\TermiiPHP\Data\PaginatedData::class)
        ->and($response->dto()->data[0])->toBeInstanceOf(\Okolaa\TermiiPHP\Data\Phonebook::class);
});

test('it can create a phonebook', closure: function () {
    expect(\Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\CreatePhonebookEndpoint::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            $response = createTestConnector()
                ->campaignApi()
                ->phoneBook()
                ->create($phonebook = new \Okolaa\TermiiPHP\Data\Phonebook(fake()->jobTitle(), fake()->sentence()))
        )
        ->toBeInstanceOf(\Saloon\Http\Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->body()->all())
        ->toHaveKey('phonebook_name', $phonebook->name)
        ->toHaveKey('description', $phonebook->description);
});