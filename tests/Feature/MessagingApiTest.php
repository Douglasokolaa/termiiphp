<?php

use Okolaa\TermiiPHP\Data\DeviceTemplate;
use Okolaa\TermiiPHP\Data\Message;
use Okolaa\TermiiPHP\Requests\Messaging\SendBulkMessageRequest;
use Okolaa\TermiiPHP\Requests\Messaging\SendMessageRequest;
use Saloon\Traits\Body\HasJsonBody;
use function Pest\Faker\fake;

test('it can send message', closure: function () {
    expect(SendMessageRequest::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            $response = createTestConnector()
                ->messagingApi()
                ->send($message = new Message(fake()->phoneNumber, fake()->company, fake()->sentence()))
        )
        ->toBeInstanceOf(\Saloon\Http\Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->body()->all())
        ->toHaveKey('to', $message->to)
        ->toHaveKey('from', $message->from)
        ->toHaveKey('sms', $message->sms);
});

test('it can send bulk message', closure: function () {
    expect(SendBulkMessageRequest::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            $response = createTestConnector()
                ->messagingApi()
                ->sendBulk($message = new Message([fake()->phoneNumber], fake()->company, fake()->sentence()))
        )
        ->toBeInstanceOf(\Saloon\Http\Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->body()->all())
        ->toHaveKey('to', $message->to)
        ->toHaveKey('from', $message->from)
        ->toHaveKey('sms', $message->sms);
});

test('it can get send device template', closure: function () {
    expect(\Okolaa\TermiiPHP\Requests\Messaging\SendDeviceTemplateRequest::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            createTestConnector()
                ->messagingApi()
                ->sendDeviceTemplate(new DeviceTemplate(fake()->phoneNumber, fake()->uuid(), []))
                ->status()
        )
        ->toBe(200);
});

test('it can send message with termii number', closure: function () {
    expect(\Okolaa\TermiiPHP\Requests\Messaging\SendMessageFromAutoNumberRequest::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            createTestConnector()
                ->messagingApi()
                ->SendMessageFromAutoNumber(fake()->phoneNumber, fake()->sentence)
                ->status()
        )
        ->toBe(200);
});

test('it can get sender ids', closure: function () {
    expect(\Okolaa\TermiiPHP\Requests\Messaging\GetSenderIdsRequest::class)
        ->toSendGetRequest()
        ->and(
            createTestConnector()
                ->senderIdApi()
                ->getIds(2)
                ->dto()
        )
        ->toBeInstanceOf(\Okolaa\TermiiPHP\Data\PaginatedData::class);
});

test('it can request sender id', closure: function () {
    expect(\Okolaa\TermiiPHP\Requests\Messaging\RequestSenderIdRequest::class)
        ->toSendPostRequest()
        ->and(
            $response = createTestConnector()
                ->senderIdApi()
                ->requestId(new \Okolaa\TermiiPHP\Data\SenderId('demo-inc', 'Demo Inc', 'send notifications'))

        )
        ->toBeInstanceOf(\Saloon\Http\Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->body()->all())
        ->toHaveKey('company', 'Demo Inc')
        ->toHaveKey('usecase', 'send notifications')
        ->toHaveKey('sender_id', 'demo-inc');
});