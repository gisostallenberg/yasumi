<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Faker\Factory;
use Yasumi\Tests\YasumiBase;
use Yasumi\Yasumi;

/**
 * Class YasumiTest.
 *
 * Contains tests for testing the Holiday class
 */
class YasumiTest extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Tests that an InvalidArgumentException is thrown in case an invalid year is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testCreateWithInvalidYear()
    {
        Yasumi::create('Japan', 10100);
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case an invalid holiday provider is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testCreateWithInvalidProvider()
    {
        Yasumi::create('Mars');
    }

    /**
     * Tests that an Yasumi\Exception\UnknownLocaleException is thrown in case an invalid locale is given.
     *
     * @expectedException Yasumi\Exception\UnknownLocaleException
     */
    public function testCreateWithInvalidLocale()
    {
        Yasumi::create('Japan', Factory::create()->numberBetween(1000, 9999), 'wx_YZ');
    }

    /**
     * Tests that the getIterator function returns an ArrayIterator object
     */
    public function testGetIterator()
    {
        $holidays = Yasumi::create('Japan', Factory::create()->numberBetween(1000, 9999));

        $this->assertInstanceOf('ArrayIterator', $holidays->getIterator());
    }

    /**
     * Tests that the count function returns an integer and a correct count for the test holiday provider
     */
    public function testCount()
    {
        $holidays = Yasumi::create('Japan', 2015);

        $this->assertInternalType('int', $holidays->count());
        $this->assertEquals(17, $holidays->count());
    }

    /**
     * Tests that the getType function returns a string for the test holiday provider
     */
    public function testGetType()
    {
        $holidays = Yasumi::create('Japan', Factory::create()->numberBetween(1949, 9999));
        $holiday  = $holidays->getHoliday('newYearsDay');

        $this->assertInternalType('string', $holiday->getType());
    }

    /**
     * Tests that the getYear function returns an integer for the test holiday provider
     */
    public function testGetYear()
    {
        $year     = Factory::create()->numberBetween(1000, 9999);
        $holidays = Yasumi::create('Netherlands', $year);

        $this->assertInternalType('integer', $holidays->getYear());
        $this->assertEquals($year, $holidays->getYear());
    }

    /**
     * Tests that the next function returns the next upcoming date (i.e. next year) for the given holiday
     */
    public function testNext()
    {
        $country = 'Japan';
        $name    = 'childrensDay';
        $year    = Factory::create()->numberBetween(1949, 9999);

        $holidays = Yasumi::create($country, $year);

        $this->assertHoliday($country, $name, $year + 1, $holidays->next($name));
    }

    /**
     * Tests the next function that an InvalidArgumentException is thrown in case a blank name is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testNextWithBlankName()
    {
        $holidays = Yasumi::create('Netherlands', Factory::create()->numberBetween(1000, 9999));
        $holidays->next(null);
    }

    /**
     * Tests the previous function returns the previous date (i.e. previous year) for the given holiday
     */
    public function testPrevious()
    {
        $country = 'Netherlands';
        $name    = 'liberationDay';
        $year    = Factory::create()->numberBetween(1949, 9999);

        $holidays = Yasumi::create($country, $year);

        $this->assertHoliday($country, $name, $year - 1, $holidays->previous($name));
    }

    /**
     * Tests the previous function that an InvalidArgumentException is thrown in case a blank name is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testPreviousWithBlankName()
    {
        $holidays = Yasumi::create('Netherlands', Factory::create()->numberBetween(1000, 9999));
        $holidays->previous(null);
    }

    /**
     * Tests that the getHolidayNames function returns an array and a correct count for the test holiday provider
     */
    public function testGetHolidayNames()
    {
        $holidays     = Yasumi::create('Japan', 2015);
        $holidayNames = $holidays->getHolidayNames();

        $this->assertInternalType('array', $holidayNames);
        $this->assertEquals(17, sizeof($holidayNames));
        $this->assertContains('newYearsDay', $holidayNames);
    }

    /**
     * Tests that the WhenIs function returns a string representation of the date the given holiday occurs.
     */
    public function testWhenIs()
    {
        $holidays = Yasumi::create('Japan', 2010);

        $when = $holidays->whenIs('autumnalEquinoxDay');

        $this->assertInternalType('string', $when);
        $this->assertEquals('2010-09-23', $when);
    }

    /**
     * Tests that the WhenIs function throws an InvalidArgumentException when a blank name is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testWhenIsWithBlankName()
    {
        $holidays = Yasumi::create('Japan', 2010);
        $holidays->whenIs(null);
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case a blank name is given for the getHoliday function.
     *
     * @expectedException InvalidArgumentException
     */
    public function testGetHolidayWithBlankName()
    {
        $holidays = Yasumi::create('Netherlands', 1999);
        $holidays->getHoliday(null);
    }

    /**
     * Tests that the whatWeekDayIs function returns an integer representation of the day of the week the given holiday
     * is occurring.
     */
    public function testWhatWeekDayIs()
    {
        $holidays = Yasumi::create('Netherlands', 2110);
        $weekDay  = $holidays->whatWeekDayIs('stMartinsDay');

        $this->assertInternalType('int', $weekDay);
        $this->assertEquals(2, $weekDay);
    }

    /**
     * Tests that the whatWeekDayIs function throws an InvalidArgumentException when a blank name is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testWhatWeekDayIsWithBlankName()
    {
        $holidays = Yasumi::create('Netherlands', 2388);
        $holidays->whatWeekDayIs(null);
    }

}
