<?php

namespace Garethellis\CrontabScheduleGenerator\Tests;

use function Garethellis\CrontabScheduleGenerator\every;
use PHPUnit_Framework_TestCase;

class HoursIntervalTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     */
    public function test_it_can_return_a_crontab_for_every_2_hours()
    {
        assertThat(
            (string)every("2")->hours(),
            is(equalTo("0 */2 * * *"))
        );
    }

    /**
     * @return void
     */
    public function test_it_can_return_a_schedule_for_every_3_hours_at_a_given_minutes()
    {
        assertThat(
            (string)every("3")->hours()->at("half past"),
            is(equalTo("30 */3 * * *"))
        );
    }

    /**
     * @return void
     */
    public function test_it_can_return_a_schedule_for_every_X_hours_from_a_given_time()
    {
        assertThat(
            (string)every("4")->hours()->from("2"),
            is(equalTo("0 2,6,10,14,18,22 * * *"))
        );
    }

    /**
     * @return void
     */
    public function test_it_can_return_a_schedule_for_every_X_hours_from_a_given_time_until_another()
    {
        assertThat(
            (string)every("6")->hours()->from("3")->until("18"),
            is(equalTo("0 3,9,15 * * *"))
        );
    }
}
