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

class NewYearsDayTest extends BulgariaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'newYearsDay';

    /**
     * @dataProvider HolidayDataProvider
     */
    public function testHoliday(int $year, \DateTime $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * @return array<array<int, \DateTime>>
     */
    public function HolidayDataProvider(): array
    {
        return $this->generateRandomDates(1, 1, self::TIMEZONE);
    }

    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Нова година']
        );
    }

    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
