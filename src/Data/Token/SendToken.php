<?php

namespace Okolaa\TermiiPHP\Data\Token;

use Okolaa\TermiiPHP\Data\Contracts\ConvertsDtoToRequestArray;
use Okolaa\TermiiPHP\Enums\PinType;
use Okolaa\TermiiPHP\Enums\TokenChannel;

class SendToken implements ConvertsDtoToRequestArray
{
    public function __construct(
        public readonly string       $messageType,
        public readonly string       $to,
        public readonly string       $from,
        public readonly TokenChannel $channel,
        public readonly string       $messageText,
        public readonly string       $pinPlaceHolder,
        public readonly PinType      $pinType,
        public readonly int          $pinAttempts = 3,
        public readonly int          $pinTimeToLiveMinute = 1,
        public readonly int          $pinLength = 6,
    )
    {
    }

    public function toRequestArray(): array
    {
        return [
            'message_type' => $this->messageType,
            'to' => $this->to,
            'from' => $this->from,
            'channel' => $this->channel->value,
            'message_text' => $this->messageText,
            'pin_placeholder' => $this->pinPlaceHolder,
            'pin_type' => $this->pinType->value,
            'pin_attempts' => $this->pinAttempts,
            'pin_time_to_live' => $this->pinTimeToLiveMinute,
            'pin_length' => $this->pinLength,
        ];
    }
}
