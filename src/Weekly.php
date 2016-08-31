<?php

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class Weekly
{
    use TimeCheckerTrait;

    private $day;

    private $hours;

    private $mins;

    public function __toString()
    {
        if (!$this->day) {
            return "";
        }

        $dayAsNumber = date("w", strtotime($this->day));

        if ($this->hours && $this->mins) {
            return sprintf("%s %s * * %s", $this->mins, $this->hours, $dayAsNumber);
        }
        return sprintf("0 0 * * %s", $dayAsNumber);
    }

    public function on($day)
    {
        $day = ucfirst(strtolower($day));

        Assertion::choice($day, [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
        ]);

        $this->day = $day;
        return $this;
    }

    public function at($time)
    {
        list($hours, $mins) = $this->checkTime($time);

        $this->hours = $hours;
        $this->mins  = $mins;

        return $this;
    }
}
