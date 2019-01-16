<?php

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

trait TimeCheckerTrait
{
    private function getHoursAndMinutesFromTimeString($time)
    {
        Assertion::notBlank($time);

        $parts = explode(":", $time);

        Assertion::allIntegerish($parts);

        $hours = "0";
        if (isset($parts[0])) {
            $hours = $parts[0] + 0;
        }

        Assertion::range($hours, "0", "23");

        $mins = "0";
        if (isset($parts[1])) {
            $mins = $parts[1] + 0;
        }

        Assertion::range($mins, "0", "59");

        return [$hours, $mins];
    }
}
