<?php

namespace Garethellis\CrontabScheduleGenerator\Tests;

use function Garethellis\CrontabScheduleGenerator\every;

class MinutesIntervalTest extends TestCase
{
    public function test_it_can_create_a_cron_schedule_for_every_x_minutes(): void
    {
        assertThat(
            (string)every("5")->minutes(),
            is(equalTo("*/5 * * * *"))
        );
    }
}
