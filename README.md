# Crontab Schedule Generator

A simple PHP library for generating Crontab schedules with expressive PHP code.

## Install

Install with Composer:

``` bash
$ composer require garethellis/crontab-schedule-generator
```

## Usage

I wrote this library for use with [Jobby][link-jobby], but it could be used in any situation where you need to output
a Crontab schedule with PHP.

I recommend using the included functions for expressive code.

### Hourly

The `Hourly` class can be used to output crontab schedules to be run on an hourly basis. The `hourly()` function
can be used to create a new instance of `Hourly`.

If you call `hourly()` by itself, you'll get a crontab schedule of "run hourly on the hour". You can specify
 the minutes past the hour to run at by using the `at()` method. This method takes either a number (0-59) or
 one of the following text strings: `on the hour`, `quarter past`, `half past` or `quarter to`.
 
 You can use the `repeatingAt` method to run a task multiple times in an hour. This method takes the same 
 argument as `at()`, i.e. a number (0-59) or a text string from the above list.
 
 ``` php
 use function Garethellis\CrontabScheduleGenerator\hourly;
 
 echo hourly();
 //outputs "0 * * * *" (i.e. run hourly on the hour)   
    
 echo hourly()->at("20");
 //outputs "20 * * * *" (i.e. run hourly at twenty past the hour)   
    
 echo hourly()->at("half past");
 //outputs "30 * * * *" (i.e. run hourly at half past the hour)
 
 echo hourly()->at("on the hour")->repeatingAt("quarter past")->repeatingAt("half past")->repeatingAt("quarter to");
 //outputs "0,15,30,45 * * * *" (i.e. run every 15 minutes)
 ```

### Daily

The `Daily` class can be used to output crontab schedules to be run on a daily basis. The `daily()` function
returns a new instance of `Daily`.

If you call `daily()` by itself, you will get a crontab schedule of "run daily at midnight". You can specify
a time to run using the `at()` method. This method takes a time in 24 hour format as its only argument.

There is also the `repeatingAt()` method if you would like to schedule a task to run multiple times in a day. This 
method takes a whole number as its only argument; this number represents the hour to repeat the job at. Note, 
this will create a schedule which repeats at the same number of minutes past the hour as whatever you specify using
 the `at()` method. It's not possible (currently) to do something like "run at 9:30, then repeat at 11:15, then repeat at "13:40". 

``` php
use function Garethellis\CrontabScheduleGenerator\daily;

echo daily();
//outputs "0 0 * * *" (i.e. run daily at midnight)   
   
echo daily()->at("4");
//outputs "0 4 * * *" (i.e. run daily at 4am)   
   
echo daily()->at("15:25");
//outputs "25 15 * * *" (i.e. run daily at 3:25pm / 15:25)

echo daily()->at("9:30")->repeatingAt("10")->repeatingAt("11");
//outputs "30 9,10,11 * * *" (i.e. run daily at 9:30, 10:30 and 11:30)
```

### Weekly

The `Weekly` class can be used to output crontab schedules to be run on a daily basis. The `weekly()` function
returns a new instance of `Weekly`.

If you call `weekly()` by itself, you will get a crontab schedule for midnight Sunday. You can specify
a day to run on using the `on()` method. This method takes a day name in English (e.g. 'Sunday') as its only argument.
If you call it like this, you will get a crontab schedule set to run on that given day at midnight. You can specify a time
to run in the same way as the `Daily` class - see above.

You can also set weekly schedules to repeat on given days using the `repeatingOn()` method, passing in a day name.

``` php
use function Garethellis\CrontabScheduleGenerator\weekly;

echo weekly();
//outputs "0 0 * * 0"   
   
echo weekly()->on("Friday");
//outputs "0 0 * * 4" (i.e. run every Friday at midnight)   
   
echo weekly()->on("Saturday")->at("12:10");
//outputs "10 12 * * 6" (i.e. run every Saturday at 12:10pm

echo weekly()->on("Saturday")->repeatingOn("Sunday");
//outputs "0 0 * * 0,6" (i.e. run every Saturday & Sunday at midnight)
```

### Monthly

The `Monthly` class allows you to output crontab schedules to be run on a monthly basis. The `monthly()` function returns
a new instance of `Monthly`.

Calling `monthly()` by itself will give you a crontab schedule for midnight on the first of the month. To specify a day to run on,
you can use an ordinal or whole number with the `on()` method. You can also use the `at()` method in the same way as with
 weekly & daily.
 
``` php
use function Garethellis\CrontabScheduleGenerator\monthly;

echo monthly();
//outputs "0 0 1 * *"   
   
echo monthly()->on("4th");
//outputs "0 0 4 * *" (i.e. run every month on the 4th at midnight)   
   
echo monthly()->on("12th")->at("10:15");
//outputs "15 10 12 * *" (i.e. run every month on the 12th at 10:15am)
```
 
 
### Every X minutes/Every X hours

The `Interval` class allows you to output crontab schedules to be run every X minutes or every X hours. This class can be instantiated
using the factory function `every()`. Unlike the other classes in this
library, this class is no good on its own, i.e. `every("5")` will not output anything. Instead, you have to use the `minutes()` and `hours()`
methods to create instances of `MinutesInterval` and `HoursInterval` respectively. From here, usage of these classes is very similar
to the above. With `HoursInterval` you can specify a start and stop time using the `from()` and `until()` methods.

```php

use function Garethellis\CrontabScheduleGenerator\every`

echo every("5")->minutes();
//outputs "*/5 * * * *" (i.e. run every 5 minutes)

echo every("2")->hours();
//outputs "0 */2 * * *" (i.e. run every 2 hours on the hour)

echo every("3")->hours()->at("half past");
//outputs "30 */3 * * *" (i.e. run every 3 hours at half past the hour)

echo every("2")->hours()->from("8")->until("14");
//outputs "0 8,10,12,14 * * *" (i.e. run on the hour at 8am, 10am, 12pm and 2pm)

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ vendor/bin/phpunit
```

## Code Style

Easily check the code style against [PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) by running:

``` bash
$ vendor/bin/phpcs src/ --standard=PSR2 --report=summary
```

And automatically fix them with this:

``` bash
$ vendor/bin/phpcbf src/ --standard=PSR2
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Gareth Ellis][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-downloads]: https://packagist.org/packages/garethellis/crontab-schedule-generator
[link-author]: https://github.com/garethellis36
[link-contributors]: ../../contributors
[link-jobby]: https://github.com/jobbyphp/jobby