<?php

namespace Okolaa\TermiiPHP\Data;

use Okolaa\TermiiPHP\Data\Contracts\ConvertsArrayToDTO;

class DeviceTemplate implements ConvertsArrayToDTO
{
    public function __construct(
        public readonly string|array $phoneNumber,
        public readonly string       $templateId,
        public readonly array        $data,
        public readonly ?string      $deviceId = null,
    )
    {
    }

    public static function fromArray(array $data): DeviceTemplate
    {
        return new self(
            phoneNumber: $data['phoneNumber'],
            templateId: $data['templateId'],
            data: $data['data'],
            deviceId: $data['deviceId'],
        );
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