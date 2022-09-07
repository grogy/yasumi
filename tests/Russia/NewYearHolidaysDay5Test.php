<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Russia;

use Exception;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for New Year's holidays day 5 in Russia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class NewYearHolidaysDay5Test extends RussiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'newYearHolidaysDay5';

    /**
     * @return array<array> list of test dates for the holiday defined in this test
     *
     * @throws Exception
     */
    public function holidayDataProvider(): array
    {
        return $this->generateRandomDates(1, 5, self::TIMEZONE);
    }

    /**
     * @dataProvider holidayDataProvider
     */
    public function testHoliday(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Новогодние каникулы']
        );
    }

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
