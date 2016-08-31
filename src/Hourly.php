<?php

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class Hourly
{
    private $mins = 0;

    private $textDescriptions = [
        "on the hour"  => "0",
        "quarter past" => "15",
        "half past"    => "30",
        "quarter to"   => "45",
    ];

    public function __toString()
    {
        if (!is_array($this->mins)) {
            return sprintf("%s * * * *", $this->mins);
        }
        return sprintf("%s * * * *", implode(",", $this->mins));
    }

    public function at($minutes)
    {
        if (!is_numeric($minutes)) {
            Assertion::choice($minutes, array_keys($this->textDescriptions));
            $minutes = $this->textDescriptions[$minutes];
        } else {
            Assertion::range($minutes, 0, 59);
        }

        $this->mins = $minutes;
        return $this;
    }

    public function repeatingAt($minutes)
    {
        if (!is_numeric($minutes)) {
            Assertion::choice($minutes, array_keys($this->textDescriptions));
            $minutes = $this->textDescriptions[$minutes];
        } else {
            Assertion::range($minutes, 0, 59);
        }

        if (!is_array($this->mins)) {
            $this->mins = [$this->mins];
        }

        if (!in_array($minutes, $this->mins)) {
            $this->mins[] = $minutes;
        }
        return $this;
    }
}
