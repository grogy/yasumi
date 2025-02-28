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

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Italy.
 */
class Italy extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'IT';

    /**
     * Initialize holidays for Italy.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Rome';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateLiberationDay();
        $this->calculateRepublicDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Italy',
            'https://it.wikipedia.org/wiki/Festivit%C3%A0_in_Italia',
        ];
    }

    /**
     * Liberation Day.
     *
     * Italy's Liberation Day (Festa della Liberazione), also known as the Anniversary of the Liberation
     * (Anniversario della liberazione d'Italia), Anniversary of the Resistance (anniversario della Resistenza), or
     * simply April 25 is a national Italian holiday commemorating the end of the second world war and the end of
     * Nazi occupation of the country. On May 27, 1949, bill 260 made the anniversary a permanent, annual national
     * holiday.
     *
     * @see https://en.wikipedia.org/wiki/Liberation_Day_%28Italy%29
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateLiberationDay(): void
    {
        if ($this->year >= 1949) {
            $this->addHoliday(new Holiday(
                'liberationDay',
                ['it' => 'Festa della Liberazione'],
                new \DateTime("{$this->year}-4-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Class containing tests for Republic Day in Italy.
     *
     * Festa della Repubblica (in English, Republic Day) is the Italian National Day and Republic Day, which is
     * celebrated on 2 June each year. The day commemorates the institutional referendum held by universal suffrage
     * in 1946, in which the Italian people were called to the polls to decide on the form of government, following
     * the Second World War and the fall of Fascism.
     *
     * @see https://en.wikipedia.org/wiki/Festa_della_Repubblica
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateRepublicDay(): void
    {
        if ($this->year >= 1946) {
            $this->addHoliday(new Holiday(
                'republicDay',
                ['it' => 'Festa della Repubblica'],
                new \DateTime("{$this->year}-6-2", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
