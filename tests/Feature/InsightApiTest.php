<?php

use Okolaa\TermiiPHP\Endpoints\Insight\GetBalanceEndpoint;
use Okolaa\TermiiPHP\Endpoints\Insight\HistoryEndpoint;
use Okolaa\TermiiPHP\Endpoints\Insight\PhoneNumberStatusEndpoint;
use Okolaa\TermiiPHP\Endpoints\Insight\SearchPhoneNumberEndpoint;
use Saloon\Http\Response;

test('it can get Balance', closure: function() {
    expect(GetBalanceEndpoint::class)
        ->toSendGetRequest()
        ->and(
            $response = createTestConnector()
                ->insightApi()
                ->getBalance()
        )
        ->toBeInstanceOf(Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getRequest()->resolveEndpoint())
        ->toBeString()
        ->toEndWith('/api/get-balance')
    ;
});

test('it can search phone number', closure: function() {
    expect(SearchPhoneNumberEndpoint::class)
        ->toSendGetRequest()
        ->and(
            $response = createTestConnector()
                ->insightApi()
                ->searchPhoneNumber('1234567890')
        )
        ->toBeInstanceOf(Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->query()->all())
        ->not()->toBeEmpty()
        ->toHaveKey('phone_number', '1234567890')
        ->and($response->getRequest()->resolveEndpoint())
        ->toBeString()
        ->toEndWith('/api/check/dnd');
});

test('it can check phone number status', closure: function() {
    expect(PhoneNumberStatusEndpoint::class)
        ->toSendGetRequest()
        ->and(
            $response = createTestConnector()
                ->insightApi()
                ->statusOfPhoneNumber('1234567890', 'US')
        )
        ->toBeInstanceOf(Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->query()->all())
        ->not()->toBeEmpty()
        ->toHaveKey('phone_number', '1234567890')
        ->toHaveKey('country_code', 'US')
        ->and($response->getRequest()->resolveEndpoint())
        ->toBeString()
        ->toEndWith('/api/insight/number/query');
});

test('it can get history', closure: function() {
    expect(HistoryEndpoint::class)
        ->toSendGetRequest()
        ->and(
            $response = createTestConnector()
                ->insightApi()
                ->history()
        )
        ->toBeInstanceOf(Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getRequest()->query()->all())
        ->toHaveKey('message_id', null)
        ->and($response->getRequest()->resolveEndpoint())
        ->toBeString()
        ->toEndWith('/api/sms/inbox')
    ;
});
