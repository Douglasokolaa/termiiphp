<?php

namespace Okolaa\TermiiPHP\Resources\Campaign;

use Okolaa\TermiiPHP\Data\Contact;
use Okolaa\TermiiPHP\Data\Phonebook;
use Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\AddContactEndpoint;
use Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\CreatePhonebookEndpoint;
use Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\DeleteContactEndpoint;
use Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\DeletePhonebookEndpoint;
use Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\GetContactsEndpoint;
use Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\GetPhonebooksEndpoint;
use Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\ImportContactEndpoint;
use Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\UpdatePhonebookEndpoint;
use Psr\Http\Message\StreamInterface;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class PhonebookResource extends BaseResource
{
    public function get(int $page = 1): Response
    {
        return $this->connector->send(new GetPhonebooksEndpoint($page));
    }

    public function create(Phonebook $phonebook): Response
    {
        return $this->connector->send(new CreatePhonebookEndpoint($phonebook));
    }

    public function update(Phonebook $phonebook): Response
    {
        return $this->connector->send(new UpdatePhonebookEndpoint($phonebook));
    }

    public function delete(string $phonebookId): Response
    {
        return $this->connector->send(new DeletePhonebookEndpoint($phonebookId));
    }

    public function getContacts(string $phonebookId, int $page = 1): Response
    {
        return $this->connector->send(new GetContactsEndpoint($phonebookId, $page));
    }

    public function addContact(string $phonebookId, Contact $contact): Response
    {
        return $this->connector->send(new AddContactEndpoint($phonebookId, $contact));
    }

    public function deleteContact(string $contactId): Response
    {
        return $this->connector->send(new DeleteContactEndpoint($contactId));
    }

    /**
     * @param string $phonebookId
     * @param string $countryCode
     * @param StreamInterface|resource|string|int $file
     */
    public function importContact(string $phonebookId, string $countryCode, $file): Response
    {
        return $this->connector->send(new ImportContactEndpoint($phonebookId, $countryCode, $file));
    }

}