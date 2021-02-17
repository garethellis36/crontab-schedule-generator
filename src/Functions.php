<?php

declare(strict_types=1);

namespace Garethellis\CrontabScheduleGenerator;

function daily(): Daily
{
    return new Daily();
}

function weekly(): Weekly
{
    return new Weekly();
}

function monthly(): Monthly
{
    return new Monthly();
}

function hourly(): Hourly
{
    return new Hourly();
}

function every(string $interval): Interval
{
    return new Interval($interval);
}
