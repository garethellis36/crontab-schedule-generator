<?php

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class HoursInterval
{
    private $interval;

    private $from = null;

    private $until = 24;

    private $mins = 0;

    private $textDescriptions = [
        "on the hour"  => "0",
        "quarter past" => "15",
        "half past"    => "30",
        "quarter to"   => "45",
    ];

    /**
     * HoursInterval constructor.
     * @param $interval
     */
    public function __construct($interval)
    {
        Assertion::integerish($interval);
        Assertion::range($interval, 1, 23);

        $this->interval = $interval;
    }

    public function __toString()
    {
        if ($this->from === null) {
            return sprintf("%s */%s * * *", $this->mins, $this->interval);
        }

        $hour = $this->from;
        $hours = [];
        while ($hour < $this->until) {
            $hours[] = $hour;
            $hour += $this->interval;
        }
        return sprintf("%s %s * * *", $this->mins, implode(",", $hours));
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

    public function from($hour)
    {
        Assertion::integerish($hour);
        Assertion::range($hour, "0", "23");

        $this->from = $hour;
        return $this;
    }

    public function until($hour)
    {
        Assertion::integerish($hour);
        Assertion::range($hour, "0", "23");

        $this->until = $hour;
        return $this;
    }
}