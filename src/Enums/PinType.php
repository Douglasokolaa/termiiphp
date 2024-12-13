<?php

namespace Okolaa\TermiiPHP\Enums;

enum PinType: string
{
    case Numeric      = 'NUMERIC';
    case AlphaNumeric = 'ALPHANUMERIC';
}
