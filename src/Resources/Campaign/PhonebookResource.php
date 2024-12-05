<?php

namespace Okolaa\TermiiPHP\Resources\Campaign;

use Okolaa\TermiiPHP\Data\Contact;
use Okolaa\TermiiPHP\Data\Phonebook;
use Okolaa\TermiiPHP\Requests\Campaign\Phonebook\AddContactRequest;
use Okolaa\TermiiPHP\Requests\Campaign\Phonebook\CreatePhonebookRequest;
use Okolaa\TermiiPHP\Requests\Campaign\Phonebook\DeleteContactRequest;
use Okolaa\TermiiPHP\Requests\Campaign\Phonebook\DeletePhonebookRequest;
use Okolaa\TermiiPHP\Requests\Campaign\Phonebook\GetContactsRequest;
use Okolaa\TermiiPHP\Requests\Campaign\Phonebook\GetPhonebooksRequest;
use Okolaa\TermiiPHP\Requests\Campaign\Phonebook\ImportContactRequest;
use Okolaa\TermiiPHP\Requests\Campaign\Phonebook\UpdatePhonebookRequest;
use Psr\Http\Message\StreamInterface;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class PhonebookResource extends BaseResource
{
    public function get(int $page = 1): Response
    {
        return $this->connector->send(new GetPhonebooksRequest($page));
    }

    public function create(Phonebook $phonebook): Response
    {
        return $this->connector->send(new CreatePhonebookRequest($phonebook));
    }

    public function update(Phonebook $phonebook): Response
    {
        return $this->connector->send(new UpdatePhonebookRequest($phonebook));
    }

    public function delete(string $phonebookId): Response
    {
        return $this->connector->send(new DeletePhonebookRequest($phonebookId));
    }

    public function getContacts(string $phonebookId, int $page = 1): Response
    {
        return $this->connector->send(new GetContactsRequest($phonebookId, $page));
    }

    public function addContact(string $phonebookId, Contact $contact): Response
    {
        return $this->connector->send(new AddContactRequest($phonebookId, $contact));
    }

    public function deleteContact(string $contactId): Response
    {
        return $this->connector->send(new DeleteContactRequest($contactId));
    }

    /**
     * @param string $phonebookId
     * @param string $countryCode
     * @param StreamInterface|resource|string|int $file
     */
    public function importContact(string $phonebookId, string $countryCode, $file): Response
    {
        return $this->connector->send(new ImportContactRequest($phonebookId, $countryCode, $file));
    }

}