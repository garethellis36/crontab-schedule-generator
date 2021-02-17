<?php

namespace Garethellis\CrontabScheduleGenerator\Tests;

use function Garethellis\CrontabScheduleGenerator\monthly;

class MonthlyTest extends TestCase
{
    public function test_by_default_it_returns_midnight_on_first(): void
    {
        assertThat(
            (string)monthly(),
            is(equalTo("0 0 1 * *"))
        );
    }


    public function test_it_can_return_a_correct_schedule_from_ordinal_day(): void
    {
        assertThat(
            (string)monthly()->on("3rd"),
            is(equalTo("0 0 3 * *"))
        );
    }


    public function test_it_can_return_a_correct_schedule_for_a_day_and_time(): void
    {
        assertThat(
            (string)monthly()->on("17th")->at("13"),
            is(equalTo("0 13 17 * *"))
        );
    }
}
