<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Netherlands;

use DateTime;

/**
 * Class ValentinesDayTest.
 */
class ValentinesDayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Valentines Day.
     *
     * @dataProvider ValentinesDayDataProvider
     *
     * @param int      $year     the year for which Valentines Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testValentinesDay($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, 'valentinesDay', $year, $expected);

    }

    /**
     * Returns a list of random test dates used for assertion of Valentines Day.
     *
     * @return array list of test dates for Valentines Day
     */
    public function ValentinesDayDataProvider()
    {
        return $this->generateRandomDates(2, 14, self::TIMEZONE);
    }
}
