<?php

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class Daily
{
    private $hours = 0;

    private $mins = 0;

    use TimeCheckerTrait;

    public function __toString()
    {
        if (!is_array($this->hours)) {
            return sprintf("%s %s * * *", $this->mins, $this->hours);
        }
        return sprintf("%s %s * * *", $this->mins, implode(",", $this->hours));
    }

    public function at($time)
    {
        list($hours, $mins) = $this->getHoursAndMinutesFromTimeString($time);

        $this->mins = $mins;
        $this->hours = $hours;
        return $this;
    }

    public function repeatingAt($hour)
    {
        Assertion::integerish($hour);
        Assertion::range($hour, "0", "23");

        if (!is_array($this->hours)) {
            $this->hours = [$this->hours];
        }

        if (!in_array($hour, $this->hours)) {
            $this->hours[] = $hour;
        }
        return $this;
    }
}
