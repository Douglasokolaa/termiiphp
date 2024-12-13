<?php

use Okolaa\TermiiPHP\Resources\Campaign\CampaignResource;
use Okolaa\TermiiPHP\Resources\Campaign\PhonebookResource;
use Okolaa\TermiiPHP\Resources\MessagingResource;
use Okolaa\TermiiPHP\Resources\SenderIdResource;
use Okolaa\TermiiPHP\Resources\TokenResource;
use Okolaa\TermiiPHP\TermiiAuthenticator;
use Okolaa\TermiiPHP\TermiiConnector;
use Saloon\Contracts\Authenticator;
use Saloon\Http\BaseResource;
use Saloon\Http\Connector;

test('getConnector returns Termii::class', closure: function() {
    expect(createTestConnector())
        ->toBeInstanceOf(TermiiConnector::class)
        ->toBeInstanceOf(Connector::class);
});

test('connector has authentication configured correctly', function() {
    expect(createTestConnector()->getAuthenticator())
        ->toBeInstanceOf(TermiiAuthenticator::class)
        ->toBeInstanceOf(Authenticator::class);
});

test('has default client config', function() {
    expect(createTestConnector()->config()->all())
        ->not()->toBeEmpty()
        ->toHaveKey('verify', true);
});

test('has default required header', function() {
    expect(createTestConnector()->headers()->all())
        ->not()->toBeEmpty()
        ->toHaveKey('Content-Type', 'application/json');
});

test('configures baseURL correctly', function() {
    $connector = new TermiiConnector('api-key', 'https://test-base-url/');

    expect($connector->resolveBaseUrl())
        ->toBe('https://test-base-url/');
});

test('senderIdApi method returns an instance of SenderIdResource', function() {
    expect(createTestConnector()->senderIdApi())
        ->toBeInstanceOf(SenderIdResource::class)
        ->toBeInstanceOf(BaseResource::class);
});

test('messagingApi returns instance of MessagingResource', function() {
    expect(createTestConnector()->messagingApi())
        ->toBeInstanceOf(MessagingResource::class)
        ->toBeInstanceOf(BaseResource::class);
});

test('campaignApi returns instance of MessagingResource', function() {
    $resource = createTestConnector()->campaignApi();
    expect($resource)->toBeInstanceOf(CampaignResource::class)
        ->toBeInstanceOf(BaseResource::class)
        ->and($resource->phoneBook())
        ->toBeInstanceOf(PhonebookResource::class)->toBeInstanceOf(BaseResource::class);
});

test('tokenApi returns instance of MessagingResource', function() {
    expect(createTestConnector()->tokenApi())
        ->toBeInstanceOf(TokenResource::class)
        ->toBeInstanceOf(BaseResource::class);
});
