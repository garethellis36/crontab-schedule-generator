<?php

namespace Garethellis\CrontabScheduleGenerator\Tests;

use function Garethellis\CrontabScheduleGenerator\hourly;

class HourlyTest extends TestCase
{
    public function test_it_can_return_an_hourly_crontab_schedule(): void
    {
        assertThat(
            (string)hourly(),
            is(equalTo("0 * * * *"))
        );
    }


    public function test_it_can_return_an_hourly_crontab_with_minutes_specified_as_text(): void
    {
        assertThat(
            (string)hourly()->at("quarter past"),
            is(equalTo("15 * * * *"))
        );
    }


    public function test_it_can_return_an_hourly_crontab_with_minutes_specified_numerically(): void
    {
        assertThat(
            (string)hourly()->at("23"),
            is(equalTo("23 * * * *"))
        );
    }


    public function test_it_can_repeat_after_a_given_number_of_minutes(): void
    {
        assertThat(
            (string)hourly()->at("quarter past")->repeatingAt("half past")->repeatingAt("quarter to")->repeatingAt("50"),
            is(equalTo("15,30,45,50 * * * *"))
        );
    }
}
