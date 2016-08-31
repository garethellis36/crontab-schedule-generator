<?php

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class Hourly
{
    private $mins = 0;

    private $textDescriptions = [
        "quarter past" => "15",
        "half past"    => "30",
        "quarter to"   => "45",
    ];

    public function __toString()
    {
        return sprintf("%s * * * *", $this->mins);
    }

    public function at($minutes)
    {
        if (!is_numeric($minutes)) {
            Assertion::choice($minutes, array_keys($this->textDescriptions));
        } else {
            Assertion::range($minutes, 0, 59);
        }

        $this->mins = $this->textDescriptions[$minutes];
        return $this;
    }
}