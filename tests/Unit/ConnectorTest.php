<?php

use Okolaa\TermiiPHP\Resources\Campaign\CampaignResource;
use Okolaa\TermiiPHP\Resources\Campaign\PhonebookResource;
use Okolaa\TermiiPHP\Resources\MessagingResource;
use Okolaa\TermiiPHP\Resources\SenderIdResource;
use Okolaa\TermiiPHP\Resources\TokenResource;
use Okolaa\TermiiPHP\Termii;
use Okolaa\TermiiPHP\TermiiAuthenticator;
use Saloon\Contracts\Authenticator;
use Saloon\Http\BaseResource;
use Saloon\Http\Connector;

test('getConnector returns Termii::class', closure: function () {
    expect(createTestConnector())
        ->toBeInstanceOf(Termii::class)
        ->toBeInstanceOf(Connector::class);
});

test('connector has authentication configured correctly', function () {
    /** @var Termii $connector */
    $connector = createTestConnector();

    expect($connector->getAuthenticator())
        ->toBeInstanceOf(TermiiAuthenticator::class)
        ->toBeInstanceOf(Authenticator::class);
});


test('has default client config', function () {
    /** @var Termii $connector */
    $connector = createTestConnector();

    expect($connector->config()->all())
        ->not()->toBeEmpty()
        ->toHaveKey('verify', false);
});

test('has default required header', function () {
    /** @var Termii $connector */
    $connector = createTestConnector();
    expect($connector->headers()->all())
        ->not()->toBeEmpty()
        ->toHaveKey('Content-Type', 'application/json');
});

test('configures baseURL correctly', function () {
    $connector = new Termii('api-key', 'https://test-base-url/');

    expect($connector->resolveBaseUrl())
        ->toBe('https://test-base-url/');
});

test('senderIdApi method returns an instance of SenderIdResource', function () {
    $termii = new Termii('fake-api-key');
    $senderIdResource = $termii->senderIdApi();

    expect($senderIdResource)
        ->toBeInstanceOf(SenderIdResource::class)
        ->toBeInstanceOf(BaseResource::class);
});

test('messagingApi returns instance of MessagingResource', function () {
    $termii = new Termii('test-api-key');
    $resource = $termii->messagingApi();

    expect($resource)->toBeInstanceOf(MessagingResource::class)->toBeInstanceOf(BaseResource::class);
});

test('campaignApi returns instance of MessagingResource', function () {
    $termii = new Termii('test-api-key');
    $resource = $termii->campaignApi();

    expect($resource)->toBeInstanceOf(CampaignResource::class)->toBeInstanceOf(BaseResource::class)
        ->and($resource->phoneBook())
        ->toBeInstanceOf(PhonebookResource::class)->toBeInstanceOf(BaseResource::class);
});

test('tokenApi returns instance of MessagingResource', function () {
    $termii = new Termii('test-api-key');
    $resource = $termii->tokenApi();

    expect($resource)->toBeInstanceOf(TokenResource::class)->toBeInstanceOf(BaseResource::class);
});