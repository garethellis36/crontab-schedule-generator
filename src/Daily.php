<?php

namespace Garethellis\CrontabScheduleGenerator;

class Daily
{
    use TimeCheckerTrait;

    public function __toString()
    {
        return "0 0 * * *";
    }

    public function at($time)
    {
        list($hours, $mins) = $this->getHoursAndMinutesFromTimeString($time);

        return "{$mins} {$hours} * * *";
    }
}
