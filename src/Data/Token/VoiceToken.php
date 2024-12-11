<?php

namespace Okolaa\TermiiPHP\Data\Token;

use Okolaa\TermiiPHP\Data\Contracts\ConvertsDtoToRequestArray;

class VoiceToken implements ConvertsDtoToRequestArray
{
    public function __construct(
        public readonly string $phoneNumber,
        public readonly int    $pinAttempts = 3,
        public readonly int    $pinTimeToLiveMinute = 1,
        public readonly int    $pinLength = 6,
    )
    {
    }

    public function toRequestArray(): array
    {
        return [
            'phone_number' => $this->phoneNumber,
            'pin_attempts' => $this->pinAttempts,
            'pin_time_to_live' => $this->pinTimeToLiveMinute,
            'pin_length' => $this->pinLength,
        ];
    }
}
