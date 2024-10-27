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

namespace Yasumi\tests\Bulgaria;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

class LiberationDayTest extends BulgariaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'liberationDay';

    private const ESTABLISHMENT_YEAR = 1990;

    public function testHoliday(): void
    {
        $year = self::ESTABLISHMENT_YEAR;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-03-03", new \DateTimeZone(self::TIMEZONE))
        );
    }

    public function testNotHoliday(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * @return array<array<int, \DateTime>>
     */
    public function HolidayDataProvider(): array
    {
        return $this->generateRandomDates(3, 3, self::TIMEZONE, null, 2000);
    }

    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Ден на Освобождението на България от османско иго']
        );
    }

    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ESTABLISHMENT_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
