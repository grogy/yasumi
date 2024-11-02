<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use Yasumi\Holiday;

class Bulgaria extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    public const ID = 'BG';

    public function initialize(): void
    {
        $this->timezone = 'Europe/Sofia';

        // // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        //
        // // Add Catholic holidays
        // $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        // $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        // $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        //
        // // Add Orthodox holidays
        //
        // $this->addHoliday(new Holiday('orthodoxChristmasDay', [
        //     'en' => 'Orthodox Christmas Day',
        //     'bs_Latn' => 'Pravoslavni Božić',
        // ], new \DateTime("{$this->year}-01-07", DateTimeZoneFactory::getDateTimeZone($this->timezone))));
        //
        // /*
        //  * Independence Day
        //  */
        // if ($this->year >= 1992) {
        //     $this->addHoliday(new Holiday('independenceDay', [
        //         'en' => 'Independence Day',
        //         'bs_Latn' => 'Dan Nezavisnosti',
        //     ], new \DateTime("{$this->year}-3-1", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        // }
        //
        // /*
        //  * Bulgarian Statehood Day
        //  */
        // if ($this->year >= 1943) {
        //     $this->addHoliday(new Holiday('statehoodDay', [
        //         'en' => 'Statehood Day',
        //         'bs_Latn' => 'Dan državnosti',
        //     ], new \DateTime("{$this->year}-11-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        // }
        //
        // /*
        //  * Day after New Years Day
        //  */
        // $this->addHoliday(new Holiday('dayAfterNewYearsDay', [
        //     'en' => 'Day after New Year’s Day',
        //     'bs_Latn' => 'Nova godina - drugi dan',
        // ], new \DateTime("{$this->year}-01-02", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        //

        if ($this->year >= 1990) {
            $this->addHoliday(new Holiday('liberationDay', [
                'bg' => 'Ден на Освобождението на България от османско иго',
            ], new \DateTime("{$this->year}-03-03", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Bulgaria',
            'https://bg.wikipedia.org/wiki/%D0%9E%D1%84%D0%B8%D1%86%D0%B8%D0%B0%D0%BB%D0%BD%D0%B8_%D0%BF%D1%80%D0%B0%D0%B7%D0%BD%D0%B8%D1%86%D0%B8_%D0%B2_%D0%91%D1%8A%D0%BB%D0%B3%D0%B0%D1%80%D0%B8%D1%8F',
        ];
    }
}
