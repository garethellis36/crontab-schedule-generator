<?php

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

trait TimeCheckerTrait
{
    private function getHoursAndMinutesFromTimeString($time)
    {
        Assertion::notBlank($time);

        $parts = array_map("trim", explode(":", $time));

        Assertion::notEmpty($parts);
        Assertion::allIntegerish($parts);

        if ($parts[0] === "0" || $parts[0] === "00") {
            $hours = "0";
        } else {
            $hours = ltrim($parts[0], "0");
        }

        Assertion::range($hours, "0", "23");

        $mins = isset($parts[1]) ? $parts[1] : "0";
        if ($mins === "0" || $mins === "00") {
            $mins = "0";
        } else {
            $mins = ltrim($mins, "0");
        }

        Assertion::range($mins, "0", "59");

        return [$hours, $mins];
    }
}
