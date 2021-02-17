<?php

declare(strict_types=1);

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class Monthly
{
    use TimeCheckerTrait;

    private $day;

    private $hours = 0;

    private $mins = 0;

    public function __toString()
    {
        if (!$this->day) {
            return sprintf("%s %s 1 * *", $this->mins, $this->hours);
        }
        return sprintf("%s %s %s * *", $this->mins, $this->hours, $this->day);
    }

    public function on(string $day): self
    {
        $ordinalSuffixes = ['th','st','nd','rd','th','th','th','th','th','th'];

        $day = str_replace($ordinalSuffixes, "", $day);

        Assertion::greaterThan($day, 0);
        Assertion::integerish($day);

        $this->day = $day;
        return $this;
    }

    public function at(string $time): self
    {
        [$hours, $mins] = $this->getHoursAndMinutesFromTimeString($time);

        $this->hours = $hours;
        $this->mins = $mins;

        return $this;
    }
}
