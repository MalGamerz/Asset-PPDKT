<?php

namespace App\Enums;

class HardwareType
{
    const DESKTOP = 'Desktop';

    const LAPTOP = 'Laptop';

    const TABLET = 'Tablet';

    const ANDROID = 'Android';

    const IPHONE = 'iPhone';

    const SERVER = 'Server';

    const PRINTER = 'Printer';

    const ROUTER = 'Router';

    const SWITCH = 'Switch';

    public static function all(): array
    {
        return [
            self::DESKTOP,
            self::LAPTOP,
            self::TABLET,
            self::ANDROID,
            self::IPHONE,
            self::SERVER,
            self::PRINTER,
            self::ROUTER,
            self::SWITCH,
        ];
    }

    public static function options(): array
    {
        $options = [];

        foreach (self::all() as $case => $value) {
            $options[$value] = ucfirst($value);
        }

        return $options;
    }
}
