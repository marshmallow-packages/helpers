<?php

namespace Marshmallow\HelperFunctions;

use Carbon\Carbon;

class DateHelper
{
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATERDAY = 6;
    const SUNDAY = 0;

    /**
     * Default is Saterday and Sunday
     * @var array
     */
    protected $weekend_days = [6,0];

    /**
     * Set the weekend days you want to use
     *
     * @param  array $array An array with integers.
     */
    public function setWeekend(array $weekend_days)
    {
        /**
         * This function will reset the current
         * weekend days so we first set it to
         * an empty array.
         *
         * @var array
         */
        $this->weekend_days = [];
        foreach ($weekend_days as $weekend_day) {
            $this->addWeekendDay($weekend_day);
        }

        return $this;
    }

    public function addWeekendDays(array $weekend_days)
    {
        foreach ($weekend_days as $weekend_day) {
            $this->addWeekendDay($weekend_day);
        }

        return $this;
    }

    public function addWeekendDay(int $weekend_day)
    {
        $this->weekend_days[] = $weekend_day;
    }

    public function addDaysWithoutWeekend(Carbon $date, int $days_to_add)
    {
        $date = clone $date;
        $days_added = 0;

        while (true) {
            $date->addDay();
            if (!in_array($date->isoFormat('d'), $this->weekend_days)) {
                $days_added++;
            }
            if ($days_added === $days_to_add) {
                break;
            }
        }

        return $date;
    }

    public function monday()
    {
        return self::MONDAY;
    }

    public function tuesday()
    {
        return self::TUESDAY;
    }

    public function wednesday()
    {
        return self::WEDNESDAY;
    }

    public function thursday()
    {
        return self::THURSDAY;
    }

    public function friday()
    {
        return self::FRIDAY;
    }

    public function saterday()
    {
        return self::SATERDAY;
    }

    public function sunday()
    {
        return self::SUNDAY;
    }
}
