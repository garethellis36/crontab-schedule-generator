<?php

namespace Garethellis\CrontabScheduleGenerator\Tests;

use PHPUnit_Framework_TestCase;
use function Garethellis\CrontabScheduleGenerator\weekly;

class WeeklyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     */
    public function test_if_no_day_set_it_defaults_to_midnight_sunday()
    {
        assertThat(
            (string)weekly(),
            is(equalTo("0 0 * * 0"))
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

    public function test_zero_is_a_valid_time()
    {
        assertThat(
            (string)weekly()->on("Thursday")->at("0"),
            is(equalTo("0 0 * * 4"))
        );
    }


    /**
     * @return void
     */
    public function test_it_can_return_a_weekly_schedule_repeated_at_a_given_day()
    {
        assertThat(
            (string)weekly()->on("Sunday")->repeatingOn("Monday"),
            is(equalTo("0 0 * * 0,1"))
        );
    }
}
