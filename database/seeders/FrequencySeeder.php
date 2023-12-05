<?php

namespace Database\Seeders;

use App\Models\Frequency;
use Illuminate\Database\Seeder;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $frequencies = [
            [
                'label' => 'Custom',
                'method' => 'cron',
                'params_details' => [
                    [
                        'name' => 'custom',
                        'description' => "Add your custom frequency",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task on a custom cron schedule"
            ],
            [
                'label' => 'Every Second',
                'method' => 'everySecond',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every second"
            ],
            [
                'label' => 'Every Two Seconds',
                'method' => 'everyTwoSeconds',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every two seconds"
            ],
            [
                'label' => 'Every Five Seconds',
                'method' => 'everyFiveSeconds',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every five seconds"
            ],
            [
                'label' => 'Every Ten Seconds',
                'method' => 'everyTenSeconds',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every ten seconds"
            ],
            [
                'label' => 'Every Fifteen Seconds',
                'method' => 'everyFifteenSeconds',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every fifteen seconds"
            ],
            [
                'label' => 'Every Twenty Seconds',
                'method' => 'everyTwentySeconds',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every twenty seconds"
            ],
            [
                'label' => 'Every Thirty Seconds',
                'method' => 'everyThirtySeconds',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every thirty seconds"
            ],
            [
                'label' => 'Every Minute',
                'method' => 'everyMinute',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every minute"
            ],
            [
                'label' => 'Every Two Minutes',
                'method' => 'everyTwoMinutes',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every two minutes"
            ],
            [
                'label' => 'Every Three Minutes',
                'method' => 'everyThreeMinutes',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every three minutes"
            ],
            [
                'label' => 'Every Four Minutes',
                'method' => 'everyFourMinutes',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every four minutes"
            ],
            [
                'label' => 'Every Five Minutes',
                'method' => 'everyFiveMinutes',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every five minutes"
            ],
            [
                'label' => 'Every Ten Minutes',
                'method' => 'everyTenMinutes',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every ten minutes"
            ],
            [
                'label' => 'Every Fifteen Minutes',
                'method' => 'everyFifteenMinutes',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every fifteen minutes"
            ],
            [
                'label' => 'Every Thirty Minutes',
                'method' => 'everyThirtyMinutes',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every thirty minutes"
            ],
            [
                'label' => 'Hourly',
                'method' => 'hourly',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every hour"
            ],
            [
                'label' => 'Hourly At',
                'method' => 'hourlyAt',
                'params_details' => [
                    [
                        'name' => 'minutes',
                        'description' => "Specify the number of minutes past every hour when you want the task to run.",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every hour at specified minutes past the hour"
            ],
            [
                'label' => 'Every Odd Hour',
                'method' => 'everyOddHour',
                'params_details' => [
                    [
                        'name' => 'minutes',
                        'description' => "Minutes to specify when to run the task in odd hours",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every odd hour"
            ],
            [
                'label' => 'Every Two Hours',
                'method' => 'everyTwoHours',
                'params_details' => [
                    [
                        'name' => 'minutes',
                        'description' => "Minutes to specify when to run the task every two hours",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every two hours"
            ],
            [
                'label' => 'Every Three Hours',
                'method' => 'everyThreeHours',
                'params_details' => [
                    [
                        'name' => 'minutes',
                        'description' => "Minutes to specify when to run the task every three hours",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every three hours"
            ],
            [
                'label' => 'Every Four Hours',
                'method' => 'everyFourHours',
                'params_details' => [
                    [
                        'name' => 'minutes',
                        'description' => "Minutes to specify when to run the task every four hours",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every four hours"
            ],
            [
                'label' => 'Every Six Hours',
                'method' => 'everySixHours',
                'params_details' => [
                    [
                        'name' => 'minutes',
                        'description' => "Minutes to specify when to run the task every six hours",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every six hours"
            ],
            [
                'label' => 'Daily',
                'method' => 'daily',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every day at midnight"
            ],
            [
                'label' => 'Daily At',
                'method' => 'dailyAt',
                'params_details' => [
                    [
                        'name' => 'time',
                        'description' => "Specify the time to run the task daily",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every day at a specified time"
            ],
            [
                'label' => 'Twice Daily',
                'method' => 'twiceDaily',
                'params_details' => [
                    [
                        'name' => 'first',
                        'description' => "Specify the first time to run the task daily",
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'second',
                        'description' => "Specify the second time to run the task daily",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task daily at specified times"
            ],
            [
                'label' => 'Twice Daily At',
                'method' => 'twiceDailyAt',
                'params_details' => [
                    [
                        'name' => 'first',
                        'description' => "Specify the first time to run the task daily",
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'second',
                        'description' => "Specify the second time to run the task daily",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task daily at specified times with specified minutes"
            ],
            [
                'label' => 'Weekly',
                'method' => 'weekly',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task every Sunday at midnight"
            ],
            [
                'label' => 'Weekly On',
                'method' => 'weeklyOn',
                'params_details' => [
                    [
                        'name' => 'day',
                        'description' => "Specify the day to run the task weekly",
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'time',
                        'description' => "Specify the time to run the task weekly",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every week on specified day and time"
            ],
            [
                'label' => 'Monthly',
                'method' => 'monthly',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task on the first day of every month at midnight"
            ],
            [
                'label' => 'Monthly On',
                'method' => 'monthlyOn',
                'params_details' => [
                    [
                        'name' => 'day',
                        'description' => "Specify the day to run the task monthly",
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'time',
                        'description' => "Specify the time to run the task monthly",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every month on specified day and time"
            ],
            [
                'label' => 'Twice Monthly',
                'method' => 'twiceMonthly',
                'params_details' => [
                    [
                        'name' => 'first',
                        'description' => "Specify the first day to run the task monthly",
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'second',
                        'description' => "Specify the second day to run the task monthly",
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'time',
                        'description' => "Specify the time to run the task monthly",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task monthly on specified days and time"
            ],
            [
                'label' => 'Last Day Of Month',
                'method' => 'lastDayOfMonth',
                'params_details' => [
                    [
                        'name' => 'time',
                        'description' => "Specify the time to run the task on the last day of the month",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task on the last day of the month at specified time"
            ],
            [
                'label' => 'Quarterly',
                'method' => 'quarterly',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task on the first day of every quarter at midnight"
            ],
            [
                'label' => 'Quarterly On',
                'method' => 'quarterlyOn',
                'params_details' => [
                    [
                        'name' => 'day',
                        'description' => "Specify the day to run the task quarterly",
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'time',
                        'description' => "Specify the time to run the task quarterly",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every quarter on specified day and time"
            ],
            [
                'label' => 'Yearly',
                'method' => 'yearly',
                'params_details' => null,
                'is_active' => true,
                'description' => "Run the task on the first day of every year at midnight"
            ],
            [
                'label' => 'Yearly On',
                'method' => 'yearlyOn',
                'params_details' => [
                    [
                        'name' => 'month',
                        'description' => "Specify the month to run the task yearly",
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'day',
                        'description' => "Specify the day to run the task yearly",
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'time',
                        'description' => "Specify the time to run the task yearly",
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => "Run the task every year on specified month, day, and time"
            ],

            [
                'label' => 'Limit to Weekdays',
                'method' => 'weekdays',
                'params_details' => null,
                'is_active' => true,
                'description' => 'Limit the task to weekdays'
            ],
            [
                'label' => 'Limit to Weekends',
                'method' => 'weekends',
                'params_details' => null,
                'is_active' => true,
                'description' => 'Limit the task to weekends'
            ],
            [
                'label' => 'Limit to Sunday',
                'method' => 'sundays',
                'params_details' => null,
                'is_active' => true,
                'description' => 'Limit the task to Sunday'
            ],
            [
                'label' => 'Limit to Monday',
                'method' => 'mondays',
                'params_details' => null,
                'is_active' => true,
                'description' => 'Limit the task to Monday'
            ],
            [
                'label' => 'Limit to Tuesday',
                'method' => 'tuesdays',
                'params_details' => null,
                'is_active' => true,
                'description' => 'Limit the task to Tuesday'
            ],
            [
                'label' => 'Limit to Wednesday',
                'method' => 'wednesdays',
                'params_details' => null,
                'is_active' => true,
                'description' => 'Limit the task to Wednesday'
            ],
            [
                'label' => 'Limit to Thursday',
                'method' => 'thursdays',
                'params_details' => null,
                'is_active' => true,
                'description' => 'Limit the task to Thursday'
            ],
            [
                'label' => 'Limit to Friday',
                'method' => 'fridays',
                'params_details' => null,
                'is_active' => true,
                'description' => 'Limit the task to Friday'
            ],
            [
                'label' => 'Limit to Saturday',
                'method' => 'saturdays',
                'params_details' => null,
                'is_active' => true,
                'description' => 'Limit the task to Saturday'
            ],
            [
                'label' => 'Limit to Specific Days',
                'method' => 'days',
                'params_details' => [
                    [
                        'name' => 'days',
                        'description' => 'Specify an array or a list of specific days',
                        'rules' => [['required', 'array']]
                    ],
                ],
                'is_active' => true,
                'description' => 'Limit the task to specific days'
            ],
            [
                'label' => 'Between',
                'method' => 'between',
                'params_details' => [
                    [
                        'name' => 'startTime',
                        'description' => 'Specify the start time',
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'endTime',
                        'description' => 'Specify the end time',
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => 'Limit the task to run between start and end times'
            ],
            [
                'label' => 'Unless Between',
                'method' => 'unlessBetween',
                'params_details' => [
                    [
                        'name' => 'startTime',
                        'description' => 'Specify the start time',
                        'rules' => [['required', 'string']]
                    ],
                    [
                        'name' => 'endTime',
                        'description' => 'Specify the end time',
                        'rules' => [['required', 'string']]
                    ],
                ],
                'is_active' => true,
                'description' => 'Limit the task to not run between start and end times'
            ],
        ];

        foreach ($frequencies as $frequency) {
            Frequency::query()->updateOrCreate(['method' => $frequency['method']], $frequency);
        }
    }
}
