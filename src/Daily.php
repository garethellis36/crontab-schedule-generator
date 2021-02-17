<?php

declare(strict_types=1);

namespace Garethellis\CrontabScheduleGenerator;

use Assert\Assertion;

class Daily
{
    use TimeCheckerTrait;

    private $hours = 0;

    private $mins = 0;

    public function __toString()
    {
        if (!is_array($this->hours)) {
            return sprintf("%s %s * * *", $this->mins, $this->hours);
        }
        return sprintf("%s %s * * *", $this->mins, implode(",", $this->hours));
    }

    public function at(string $time): self
    {
        list($hours, $mins) = $this->getHoursAndMinutesFromTimeString($time);

        $this->mins = $mins;
        $this->hours = $hours;
        return $this;
    }

    public function repeatingAt(string $hour): self
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
