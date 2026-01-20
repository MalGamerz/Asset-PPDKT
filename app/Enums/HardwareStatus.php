<?php

namespace App\Enums;

class HardwareStatus
{
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';
    const FAULTY = 'Faulty';
    const OUT_OF_SERVICE = 'Out Service';
    const UNDER_MAINTENANCE = 'Under Maintenance';
    const OFFLINE = 'Offline';
    const ONLINE = 'Online';
    const PENDING = 'Pending';
    const DECOMMISSIONED = 'Decommissioned';
    const UPGRADING = 'Upgrading';
    const UNAVAILABLE = 'Unavailable';
    const ERROR = 'Error';
    const READY = 'Ready';
    const UNKNOWN = 'Unknown';

    public static function all(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::FAULTY,
            self::OUT_OF_SERVICE,
            self::UNDER_MAINTENANCE,
            self::OFFLINE,
            self::ONLINE,
            self::PENDING,
            self::DECOMMISSIONED,
            self::UPGRADING,
            self::UNAVAILABLE,
            self::ERROR,
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
