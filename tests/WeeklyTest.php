<?php

namespace Garethellis\CrontabScheduleGenerator\Tests;

use function Garethellis\CrontabScheduleGenerator\weekly;

class WeeklyTest extends TestCase
{
    public function test_if_no_day_set_it_defaults_to_midnight_sunday(): void
    {
        assertThat(
            (string)weekly(),
            is(equalTo("0 0 * * 0"))
        );
    }


    public function test_it_can_return_a_weekly_schedule_for_a_given_day_with_default_run_time_of_midnight(): void
    {
        assertThat(
            (string)weekly()->on("Tuesday"),
            is(equalTo("0 0 * * 2"))
        );
    }


    public function test_it_can_return_a_weekly_schedule_for_a_given_day_at_given_time(): void
    {
        assertThat(
            (string)weekly()->on("Thursday")->at("04:09"),
            is(equalTo("9 4 * * 4"))
        );
    }


    public function test_it_can_return_a_weekly_schedule_for_a_given_day_at_a_given_time_with_trailing_zeros_in_time(): void
    {
        assertThat(
            (string)weekly()->on("Thursday")->at("04:00"),
            is(equalTo("0 4 * * 4"))
        );
    }

    /**
     * @dataProvider times
     */
    public function test_zero_is_a_valid_time($time)
    {
        assertThat(
            (string)weekly()->on("Thursday")->at($time),
            is(equalTo("0 0 * * 4"))
        );
    }

    public function times()
    {
        return [
            ["0"],
            ["00:00"],
            ["0:00"],
        ];
    }



    public function test_it_can_return_a_weekly_schedule_repeated_at_a_given_day(): void
    {
        assertThat(
            (string)weekly()->on("Sunday")->repeatingOn("Monday"),
            is(equalTo("0 0 * * 0,1"))
        );
    }
}
