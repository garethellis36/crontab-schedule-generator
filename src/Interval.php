<?php

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class Interval
{
    private $interval;

    public function __construct($interval)
    {
        Assertion::integerish($interval);
        Assertion::greaterThan($interval, 0);

        $this->interval = $interval;
    }

    public function minutes()
    {
        return new MinutesInterval($this->interval);
    }

    public function hours()
    {
        return new HoursInterval($this->interval);
    }
}
