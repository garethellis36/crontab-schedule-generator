<?php

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class Weekly
{
    use TimeCheckerTrait;

    private $day = 0;

    private $hours = 0;

    private $mins = 0;

    public function __toString()
    {
        if (!is_array($this->day)) {
            return sprintf("%s %s * * %s", $this->mins, $this->hours, $this->day);
        }

        return sprintf("%s %s * * %s", $this->mins, $this->hours, implode(",", $this->day));
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

        $this->day = date("w", strtotime($day));
        return $this;
    }

    public function at($time)
    {
        list($hours, $mins) = $this->getHoursAndMinutesFromTimeString($time);

        $this->hours = $hours;
        $this->mins  = $mins;

        return $this;
    }

    public function repeatingOn($day)
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

        if (!is_array($this->day)) {
            $this->day = [$this->day];
        }

        if (!in_array($day, $this->day)) {
            $this->day[] = date("w", strtotime($day));
        }

        return $this;
    }
}
