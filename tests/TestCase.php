<?php

namespace Tests;

use Okolaa\TermiiPHP\Requests\Campaign\Phonebook\CreatePhonebookRequest;
use Okolaa\TermiiPHP\Requests\Campaign\Phonebook\GetPhonebooksRequest;
use Okolaa\TermiiPHP\Requests\Messaging\GetSenderIdsRequest;
use Okolaa\TermiiPHP\Requests\Messaging\RequestSenderIdRequest;
use Okolaa\TermiiPHP\Requests\Messaging\SendBulkMessageRequest;
use Okolaa\TermiiPHP\Requests\Messaging\SendDeviceTemplateRequest;
use Okolaa\TermiiPHP\Requests\Messaging\SendMessageFromAutoNumberRequest;
use Okolaa\TermiiPHP\Requests\Messaging\SendMessageRequest;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

abstract class TestCase extends BaseTestCase
{

    public static function initGlobalMockClient(): void
    {
        MockClient::global([
            '/test' => MockResponse::make(),
            SendMessageRequest::class => MockResponse::make([
                'message_id' => '9122821270554876574',
                'message' => 'Successfully Sent',
                'balance' => 9,
                'user' => 'Peter Mcleish'
            ]),
            SendBulkMessageRequest::class => MockResponse::make([
                'code' => 'ok',
                'message_id' => '9122821270554876574',
                'message' => 'Successfully Sent',
                'balance' => 9,
                'user' => 'Peter Mcleish'
            ]),
            SendDeviceTemplateRequest::class => MockResponse::make([
                'code' => 'ok',
                'message_id' => '2255298515609943356',
                'message' => 'Successfully Sent',
                'balance' => 'unlimited',
                'user' => 'Termii Inc.'
            ]),
            SendMessageFromAutoNumberRequest::class => MockResponse::make([
                'code' => 'ok',
                'message_id' => '174749423',
                'message' => 'Successfully Sent',
                'balance' => 8,
                'user' => 'Seun Junior'
            ]),
            GetSenderIdsRequest::class => MockResponse::fixture('get_sender_ids.json'),
            RequestSenderIdRequest::class => MockResponse::make(),
            GetPhonebooksRequest::class => MockResponse::fixture('get_phonebooks.json'),
            CreatePhonebookRequest::class => MockResponse::make(),
        ]);
    }
}
