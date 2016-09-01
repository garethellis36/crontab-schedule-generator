<?php

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class MinutesInterval
{
    private $interval;

    /**
     * MinutesInterval constructor.
     * @param $interval
     */
    public function __construct($interval)
    {
        Assertion::integerish($interval);
        Assertion::range($interval, 1, 59);

        $this->interval = $interval;
    }

    public function __toString()
    {
        return sprintf("*/%s * * * *", $this->interval);
    }
}