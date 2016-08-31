<?php

namespace Garethellis\CrontabScheduleGenerator;

function daily()
{
    return new Daily();
}

function weekly()
{
    return new Weekly();
}
