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

### Daily

The `Daily` class can be used to output crontab schedules to be run on a daily basis. The `daily()` function
returns a new instance of `Daily`.

If you call `daily()` by itself, you will get a crontab scheduled of "run daily at midnight". You can specify
a time to run using the `at()` method. This method takes a time in 24 hour format as its only argument.

``` php
use function Garethellis\CrontabScheduleGenerator\daily;

echo daily();
//outputs "0 0 * * *" (i.e. run daily at midnight)   
   
echo daily()->at("4");
//outputs "0 4 * * *" (i.e. run daily at 4am)   
   
echo daily()->at("15:25");
//outputs "25 15 * * *" (i.e. run daily at 3:25pm / 15:25
```

### Weekly

The `Weekly` class can be used to output crontab schedules to be run on a daily basis. The `weekly()` function
returns a new instance of `Weekly`.

If you call `weekly()` by itself, you will get blank string. In order to get a crontab schedule, you must specify
a day to run on using the `on()` method. This method takes a day name in English (e.g. 'Sunday') as its only argument.
If you call it like this, you will get a crontab schedule set to run on that given day at midnight. You can specify a time
to run in the same way as the `Daily` class - see above.

``` php
use function Garethellis\CrontabScheduleGenerator\weekly;

echo weekly();
//outputs ""   
   
echo weekly()->on("Friday");
//outputs "0 0 * * 4" (i.e. run every Friday at midnight)   
   
echo weekly()->on("Saturday")->at("12:10");
//outputs "10 12 * * 6" (i.e. run every Saturday at 12:10pm
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