<?php

namespace Okolaa\TermiiPHP\Data;

class DeviceTemplate
{
    public function __construct(
        public readonly string|array $phoneNumber,
        public readonly string       $templateId,
        public readonly array        $data,
        public readonly ?string      $deviceId = null,
    )
    {
    }

    public function toRequestArray(): array
    {
        return [
            'phone_number' => $this->phoneNumber,
            'template_id' => $this->templateId,
            'device_id' => $this->deviceId,
            'data' => $this->data,
        ];
    }
}