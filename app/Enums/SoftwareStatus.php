<?php

namespace App\Enums;

class SoftwareStatus
{
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';
    const PENDING = 'Pending';
    const UNAVAILABLE = 'Unavailable';
    const READY = 'Ready';
    const UNKNOWN = 'Unknown';

    public static function all(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::PENDING,
            self::UNAVAILABLE,
            self::READY,
            self::UNKNOWN,
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
