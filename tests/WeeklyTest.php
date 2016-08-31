<?php

namespace Garethellis\CrontabScheduleGenerator\Tests;

use PHPUnit_Framework_TestCase;
use function Garethellis\CrontabScheduleGenerator\weekly;

class WeeklyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     */
    public function test_blank_string_returned_if_no_day_set()
    {
        assertThat(
            (string)weekly(),
            is(equalTo(""))
        );
    }

    /**
     * @return void
     */
    public function test_it_can_return_a_weekly_schedule_for_a_given_day_with_default_run_time_of_midnight()
    {
        assertThat(
            (string)weekly()->on("Tuesday"),
            is(equalTo("0 0 * * 2"))
        );
    }

    /**
     * @return void
     */
    public function test_it_can_return_a_weekly_schedule_for_a_given_day_at_given_time()
    {
        assertThat(
            (string)weekly()->on("Thursday")->at("04:09"),
            is(equalTo("9 4 * * 4"))
        );
    }
}
