<?php

namespace Garethellis\CrontabScheduleGenerator\Tests;

use Assert\InvalidArgumentException;
use function Garethellis\CrontabScheduleGenerator\daily;

class DailyTest extends TestCase
{
    public function test_default_daily_schedule_is_midnight(): void
    {
        assertThat(
            (string)daily(),
            is(equalTo("0 0 * * *"))
        );
    }


    public function test_it_can_return_a_daily_schedule_for_a_given_time(): void
    {
        assertThat(
            (string)daily()->at("11:34"),
            is(equalTo("34 11 * * *"))
        );
    }


    public function test_leading_zeros_are_stripped_from_times(): void
    {
        assertThat(
            (string)daily()->at("8:02"),
            is(equalTo("2 8 * * *"))
        );
    }


    public function test_a_time_is_returned_if_only_an_hour_is_provided(): void
    {
        assertThat(
            (string)daily()->at("15"),
            is(equalTo("0 15 * * *"))
        );
    }


    public function test_it_doesnt_allow_non_numeric_characters_in_time_parameter_except_for_colon(): void
    {
        $this->expectException(InvalidArgumentException::class);
        daily()->at("3pm");
    }


    public function test_it_can_return_a_schedule_starting_at_a_point_and_repeating_at_given_hours(): void
    {
        assertThat(
            (string)daily()->at("9")->repeatingAt("12")->repeatingAt("16"),
            is(equalTo("0 9,12,16 * * *"))
        );

        assertThat(
            (string)daily()->at("8:15")->repeatingAt("10")->repeatingAt("23")->repeatingAt("23"),
            is(equalTo("15 8,10,23 * * *"))
        );
    }
}
