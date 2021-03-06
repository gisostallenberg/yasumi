<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Japan;

use DateTime;
use DateTimeZone;

/**
 * Class MarineDayTest.
 */
class MarineDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'marineDay';

    /**
     * Tests Marine Day after 2003. Marine Day was established since 1996 on July 20th. After 2003 it was changed
     * to be the third monday of July.
     */
    public function testMarineDayOnAfter2003()
    {
        $year = $this->generateRandomYear(2004);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("third monday of july $year", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Marine Day between 1996 and 2003. Marine Day was established since 1996 on July 20th. After 2003 it was
     * changed to be the third monday of July.
     */
    public function testMarineDayBetween1996And2003()
    {
        $year = 2001;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-7-20", new DateTimeZone(self::TIMEZONE)));
        $year = 1997;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-7-21", new DateTimeZone(self::TIMEZONE))); // Substituted day
    }

    /**
     * Tests Marine Day before 1996. Marine Day was established since 1996 on July 20th. After 2003 it was changed
     * to be the third monday of July.
     */
    public function testMarineDayBefore1996()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1995));
    }
}
