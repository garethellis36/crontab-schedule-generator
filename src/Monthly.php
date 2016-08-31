<?php

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

    public function on($day)
    {
        $formatter = new \NumberFormatter("en_US", \NumberFormatter::DECIMAL);
        $day = $formatter->format($day);

        Assertion::greaterThan($day, 0);
        Assertion::integerish($day);

        $this->day = $day;
        return $this;
    }

    public function at($time)
    {
        list($hours, $mins) = $this->getHoursAndMinutesFromTimeString($time);

        $this->hours = $hours;
        $this->mins = $mins;

        return $this;
    }
}
