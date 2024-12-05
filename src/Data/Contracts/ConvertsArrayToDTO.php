<?php

namespace Okolaa\TermiiPHP\Data\Contracts;

interface ConvertsArrayToDTO
{
    public static function fromArray(array $data): self;
}