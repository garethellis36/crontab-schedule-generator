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
        if (60 % $interval) {
            throw new \InvalidArgumentException(
                "Argument passed to MinutesInterval constructor must be a divisor of 60"
            );
        }

        $this->interval = $interval;
    }

    public function __toString()
    {
        return sprintf("*/%s * * * *", $this->interval);
    }
}
