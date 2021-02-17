<?php

declare(strict_types=1);

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class Interval
{
    private $interval;

    public function __construct(string $interval)
    {
        Assertion::integerish($interval);
        Assertion::greaterThan($interval, 0);

        $this->interval = $interval;
    }

    public function minutes(): MinutesInterval
    {
        return new MinutesInterval($this->interval);
    }

    public function hours(): HoursInterval
    {
        return new HoursInterval($this->interval);
    }
}
