<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Belgium;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Pentecost.
 *
 * Pentecost a feast commemorating the descent of the Holy Spirit upon the Apostles and other followers of Jesus Christ.
 * It is celebrated 49 days after Easter and always takes place on Sunday.
 */
class PentecostTest extends BelgiumBaseTestCase
{
    /**
     * Tests Pentecost.
     */
    public function testPentecost()
    {
        $year = 2025;
        $this->assertHoliday(self::COUNTRY, 'pentecost', $year,
            new DateTime("$year-6-8", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Pentecost Monday.
     */
    public function testPentecostMonday()
    {
        $year = 2025;
        $this->assertHoliday(self::COUNTRY, 'pentecostMonday', $year,
            new DateTime("$year-6-9", new DateTimeZone(self::TIMEZONE)));
    }
}
