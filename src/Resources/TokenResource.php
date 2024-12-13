<?php

namespace Okolaa\TermiiPHP\Resources;

use Okolaa\TermiiPHP\Data\Token\InAppToken;
use Okolaa\TermiiPHP\Data\Token\SendToken;
use Okolaa\TermiiPHP\Data\Token\VoiceToken;
use Okolaa\TermiiPHP\Endpoints\Token\EmailTokenEndpoint;
use Okolaa\TermiiPHP\Endpoints\Token\InAppTokenEndpoint;
use Okolaa\TermiiPHP\Endpoints\Token\SendTokenEndpoint;
use Okolaa\TermiiPHP\Endpoints\Token\VerifyTokenEndpoint;
use Okolaa\TermiiPHP\Endpoints\Token\VoiceCallEndpoint;
use Okolaa\TermiiPHP\Endpoints\Token\VoiceTokenEndpoint;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

/**
 * Token allows businesses to generate, send, and verify one-time-passwords.
 */
class TokenResource extends BaseResource
{
    public function email(string $emailAddress, string $code, string $emailConfigurationId): Response
    {
        return $this->connector->send(new EmailTokenEndpoint($emailAddress, $code, $emailConfigurationId));
    }

    public function inApp(InAppToken $inAppToken): Response
    {
        return $this->connector->send(new InAppTokenEndpoint($inAppToken));
    }

    public function send(SendToken $sendToken): Response
    {
        return $this->connector->send(new SendTokenEndpoint($sendToken));
    }

    public function verify(string $pinId, string $pinCode): Response
    {
        return $this->connector->send(new VerifyTokenEndpoint($pinId, $pinCode));
    }

    public function voiceCall(string $phoneNumber, string $code): Response
    {
        return $this->connector->send(new VoiceCallEndpoint($phoneNumber, $code));
    }

    public function voice(VoiceToken $voiceToken): Response
    {
        return $this->connector->send(new VoiceTokenEndpoint($voiceToken));
    }
}
