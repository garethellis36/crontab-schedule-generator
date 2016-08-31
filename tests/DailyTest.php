<?php

namespace Garethellis\CrontabScheduleGenerator\Tests;

use Assert\InvalidArgumentException;
use PHPUnit_Framework_TestCase;
use function Garethellis\CrontabScheduleGenerator\daily;

class DailyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     */
    public function test_default_daily_schedule_is_midnight()
    {
        assertThat(
            (string)daily(),
            is(equalTo("0 0 * * *"))
        );
    }

    /**
     * @return void
     */
    public function test_it_can_return_a_daily_schedule_for_a_given_time()
    {
        assertThat(
            (string)daily()->at("11:34"),
            is(equalTo("34 11 * * *"))
        );
    }

    /**
     * @return void
     */
    public function test_leading_zeros_are_stripped_from_times()
    {
        assertThat(
            (string)daily()->at("8:02"),
            is(equalTo("2 8 * * *"))
        );
    }

    /**
     * @return void
     */
    public function test_a_time_is_returned_if_only_an_hour_is_provided()
    {
        assertThat(
            (string)daily()->at("15"),
            is(equalTo("0 15 * * *"))
        );
    }

    /**
     * @return void
     */
    public function test_it_doesnt_allow_non_numeric_characters_in_time_parameter_except_for_colon()
    {
        $this->expectException(InvalidArgumentException::class);
        daily()->at("3pm");
    }
}
