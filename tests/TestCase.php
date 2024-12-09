<?php

namespace Tests;

use Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\CreatePhonebookEndpoint;
use Okolaa\TermiiPHP\Endpoints\Campaign\Phonebook\GetPhonebooksEndpoint;
use Okolaa\TermiiPHP\Endpoints\Messaging\GetSenderIdsEndpoint;
use Okolaa\TermiiPHP\Endpoints\Messaging\RequestSenderIdEndpoint;
use Okolaa\TermiiPHP\Endpoints\Messaging\SendBulkMessageEndpoint;
use Okolaa\TermiiPHP\Endpoints\Messaging\SendDeviceTemplateEndpoint;
use Okolaa\TermiiPHP\Endpoints\Messaging\SendMessageFromAutoNumberEndpoint;
use Okolaa\TermiiPHP\Endpoints\Messaging\SendMessageEndpoint;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

abstract class TestCase extends BaseTestCase
{

    public static function initGlobalMockClient(): void
    {
        MockClient::global([
            '/test' => MockResponse::make(),
            SendMessageEndpoint::class => MockResponse::make([
                'message_id' => '9122821270554876574',
                'message' => 'Successfully Sent',
                'balance' => 9,
                'user' => 'Peter Mcleish'
            ]),
            SendBulkMessageEndpoint::class => MockResponse::make([
                'code' => 'ok',
                'message_id' => '9122821270554876574',
                'message' => 'Successfully Sent',
                'balance' => 9,
                'user' => 'Peter Mcleish'
            ]),
            SendDeviceTemplateEndpoint::class => MockResponse::make([
                'code' => 'ok',
                'message_id' => '2255298515609943356',
                'message' => 'Successfully Sent',
                'balance' => 'unlimited',
                'user' => 'Termii Inc.'
            ]),
            SendMessageFromAutoNumberEndpoint::class => MockResponse::make([
                'code' => 'ok',
                'message_id' => '174749423',
                'message' => 'Successfully Sent',
                'balance' => 8,
                'user' => 'Seun Junior'
            ]),
            GetSenderIdsEndpoint::class => MockResponse::fixture('get_sender_ids.json'),
            RequestSenderIdEndpoint::class => MockResponse::make(),
            GetPhonebooksEndpoint::class => MockResponse::fixture('get_phonebooks.json'),
            CreatePhonebookEndpoint::class => MockResponse::make(),
        ]);
    }
}
