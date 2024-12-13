<?php

namespace Tests;

use Okolaa\TermiiPHP\TermiiAuthenticator;
use Saloon\Enums\Method;
use Saloon\Http\PendingRequest;

test('TermiiAuthenticator sets API key in query for GET method', function() {
    $pendingRequest = new PendingRequest(createTestConnector(), createTestEndpoint());
    $authenticator  = new TermiiAuthenticator('test_api_key');

    $authenticator->set($pendingRequest);

    expect($pendingRequest->query()->all())->toHaveKey('api_key', 'test_api_key');
});

test('TermiiAuthenticator sets API key in query for DELETE method', function() {
    $pendingRequest = new PendingRequest(createTestConnector(), createTestEndpoint(Method::DELETE));
    $authenticator  = new TermiiAuthenticator('test_api_key');

    $authenticator->set($pendingRequest);

    expect($pendingRequest->query()->all())->toHaveKey('api_key', 'test_api_key');
});

test('TermiiAuthenticator sets API key in body for POST method', function() {
    $pendingRequest = new PendingRequest(createTestConnector(), createTestEndpoint(Method::POST));
    $authenticator  = new TermiiAuthenticator('test_api_key');

    $authenticator->set($pendingRequest);

    expect($pendingRequest->body()->all())->toHaveKey('api_key', 'test_api_key');
});

test('TermiiAuthenticator does not set API key in query for POST method', function() {
    $pendingRequest = new PendingRequest(createTestConnector(), createTestEndpoint(Method::POST));
    $authenticator  = new TermiiAuthenticator('test_api_key');

    $authenticator->set($pendingRequest);

    expect($pendingRequest->query()->all())->not->toHaveKey('api_key');
});
