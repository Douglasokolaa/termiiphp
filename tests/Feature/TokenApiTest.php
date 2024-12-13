<?php

use Okolaa\TermiiPHP\Data\Token\InAppToken;
use Okolaa\TermiiPHP\Data\Token\SendToken;
use Okolaa\TermiiPHP\Data\Token\VoiceToken;
use Okolaa\TermiiPHP\Endpoints\Token\EmailTokenEndpoint;
use Okolaa\TermiiPHP\Endpoints\Token\SendTokenEndpoint;
use Okolaa\TermiiPHP\Endpoints\Token\VerifyTokenEndpoint;
use Okolaa\TermiiPHP\Endpoints\Token\VoiceTokenEndpoint;
use Okolaa\TermiiPHP\Enums\PinType;
use Okolaa\TermiiPHP\Enums\TokenChannel;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

test('it can send token', closure: function() {
    expect(SendTokenEndpoint::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            $response = createTestConnector()
                ->tokenApi()
                ->send(new SendToken(
                    'NUMERIC',
                    '23490126727',
                    'Termii',
                    TokenChannel::GENERIC,
                    '123456',
                    '< 1234 >',
                    PinType::AlphaNumeric,
                ))
        )
        ->toBeInstanceOf(Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->body()->all())
        ->toHaveKeys([
            'message_type',
            'to',
            'from',
            'channel',
            'pin_attempts',
            'pin_time_to_live',
            'pin_length',
            'pin_placeholder',
            'message_text',
            'message_text',
        ])
        ->and($response->getRequest()->resolveEndpoint())
        ->toBeString()
        ->toEndWith('/api/sms/otp/send');
});
test('it can verify token', closure: function() {
    expect(VerifyTokenEndpoint::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            $response = createTestConnector()
                ->tokenApi()
                ->verify('123456', '23490126727')
        )
        ->toBeInstanceOf(Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->body()->all())
        ->toHaveKeys([
            'pin_id',
            'pin',
        ])
        ->and($response->getRequest()->resolveEndpoint())
        ->toBeString()
        ->toEndWith('/api/sms/otp/verify');
});

test('it can request token', closure: function() {
    expect(EmailTokenEndpoint::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            $response = createTestConnector()
                ->tokenApi()
                ->email('test@test.com', '1234', 'config-id')
        )
        ->toBeInstanceOf(Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->body()->all())
        ->toHaveKeys([
            'email_address',
            'code',
            'email_configuration_id'
        ])
        ->and($response->getRequest()->resolveEndpoint())
        ->toBeString()
        ->toEndWith('/api/email/otp/send');
});

test('it can check token status', closure: function() {
    expect(\Okolaa\TermiiPHP\Endpoints\Token\InAppTokenEndpoint::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            $response = createTestConnector()
                ->tokenApi()
                ->inApp(new InAppToken(PinType::Numeric, '2348000000000', 1))
        )
        ->toBeInstanceOf(Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->body()->all())
        ->toHaveKeys([
            'pin_type',
            'phone_number',
            'pin_attempts',
            'pin_time_to_live',
            'pin_length',
        ])
        ->and($response->getRequest()->resolveEndpoint())
        ->toBeString()
        ->toEndWith('/api/sms/otp/generate');
});

test('it can send voice token', closure: function() {
    expect(VoiceTokenEndpoint::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            $response = createTestConnector()
                ->tokenApi()
                ->voice(new VoiceToken(
                    '23490126727',
                ))
        )
        ->toBeInstanceOf(Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->body()->all())
        ->toHaveKeys([
            'phone_number',
            'pin_attempts',
            'pin_time_to_live',
            'pin_length',
        ])
        ->and($response->getRequest()->resolveEndpoint())
        ->toBeString()
        ->toEndWith('/api/sms/otp/send/voice');
});

test('it can send voice call token', closure: function() {
    expect(\Okolaa\TermiiPHP\Endpoints\Token\VoiceCallEndpoint::class)
        ->toSendPostRequest()
        ->toUse(HasJsonBody::class)
        ->and(
            $response = createTestConnector()
                ->tokenApi()
                ->voiceCall('23490126727', '123456')
        )
        ->toBeInstanceOf(Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->getPendingRequest()->body()->all())
        ->toHaveKey('phone_number', '23490126727')
        ->toHaveKey('code', '123456')
        ->and($response->getRequest()->resolveEndpoint())
        ->toBeString()
        ->toEndWith('/api/sms/otp/call');
});
