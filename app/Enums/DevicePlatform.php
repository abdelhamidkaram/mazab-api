<?php

namespace App\Enums;

enum DevicePlatform: string
{
    case Android = 'android';
    case IOS = 'ios';
    case Web = 'web';
    case Unknown = 'unknown';
}
