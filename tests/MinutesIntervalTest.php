<?php

namespace Garethellis\CrontabScheduleGenerator\Tests;

use function Garethellis\CrontabScheduleGenerator\every;
use PHPUnit_Framework_TestCase;

class MinutesIntervalTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     */
    public function test_it_can_create_a_cron_schedule_for_every_x_minutes()
    {
        assertThat(
            (string)every("5")->minutes(),
            is(equalTo("*/5 * * * *"))
        );
    }
}
