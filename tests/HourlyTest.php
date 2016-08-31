<?php


use function Garethellis\CrontabScheduleGenerator\hourly;

class HourlyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     */
    public function test_it_can_return_an_hourly_crontab_schedule()
    {
        assertThat(
            (string)hourly(),
            is(equalTo("0 * * * *"))
        );
    }

    /**
     * @return void
     */
    public function test_it_can_return_an_hourly_crontab_with_minutes_specified_as_text()
    {
        assertThat(
            (string)hourly()->at("quarter past"),
            is(equalTo("15 * * * *"))
        );
    }

    /**
     * @return void
     */
    public function test_it_can_return_an_hourly_crontab_with_minutes_specified_numerically()
    {
        assertThat(
            (string)hourly()->at("23"),
            is(equalTo("23 * * * *"))
        );
    }
}
