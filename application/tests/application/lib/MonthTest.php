<?php

class MonthTest extends PHPUnit_Framework_TestCase {
    
   
    /**
     * Checks Month::days returns correct number of days in month
     * 
     * @covers Month::days
     * 
     * @dataProvider providerTestReturnsValidDays
     */
    public function testReturnsValidDays($month,$year, $ans) {
        $thismonth = new Month($month, $year);
        
        $result = $thismonth->days();
        
        $this->assertEquals($ans, $result);
    }
    
 
    /**
     * Checks Month::days returns correct number of days in month if 
     * month and year passed to function rather than use object variables
     * 
     * @covers Month::days
     * 
     * @dataProvider providerTestReturnsValidDays
     * 
     */
    public function testReturnsValidDaysDirectly($month,$year,$ans) {
        $thismonth = new Month();
        
        $result = $thismonth->days($month,$year);
        
        $this->assertEquals($ans, $result);
    }
    
    /**
     * dataProvider for testReturnsValidDays and testReturnsValidDaysDirectly
     * 
     * @return array
     */
    public function providerTestReturnsValidDays() {
        return array(
            array(1,2012,31), //Jan - 31 days
            array(2,2014,28), //feb - 28 days
            array(2,2016,29), //feb leap year - 29 days
            array(3,2000,31), //mar - 31 days
            array(4,2020,30), //apr - 30 days
            array(5,2011,31), //may - 31 days
            array(6,2008,30), //jun - 30 days
            array(7,2010,31), //jul - 31 days
            array(8,2001,31), //aug - 31 days
            array(9,1998,30), //sep - 30 days
            array(10,1996,31), //oct - 31 days
            array(11,1977,30), //nov - 30 days
            array(12,1954,31),  //dec - 31 days
            array(1,2018,31)  //JAN 2018 - 31 days
             
        );
    }
    
    
    
    /**
     * checks Months::firstday returns correct int representing day of first of 
     * month
     * 
     * @covers Month::firstday
     * 
     * @dataProvider providerTestReturnsValidFirstDay
     */
    public function testReturnsValidFirstDay($month,$year,$ans) {
        $month = new Month($month, $year);
        
        $result = $month->firstday();
        
        $this->assertEquals($ans, $result);
    }
    
    public function providerTestReturnsValidFirstDay() {
       return array (
           array(8,2005,1), //mon
           array(5,2007,2), //tue
           array(9,2010,3), //wed
           array(10,2015,4), //thu
           array(1,2010,5), //fri
           array(12,2007,6), //sat
           array(10,2006,0), //sun
       ); 
    }
    
    
    /**
     * checks Months::lastday returns correct int representing day of last of 
     * month
     * 
     * @covers Month::lastday
     * 
     * @dataProvider providerTestReturnsValidLastDay
     */
    public function testReturnsValidLastDay($month,$year,$ans) {
        $month = new Month($month, $year);
        
        $result = $month->lastday();
        
        $this->assertEquals($ans, $result);
    }
    
    public function providerTestReturnsValidLastDay() {
       return array (
           array(1,2005,1), //mon
           array(7,2007,2), //tue
           array(2,2012,3), //wed
           array(9,2010,4), //thu
           array(1,2014,5), //fri
           array(3,2007,6), //sat
           array(2,2010,0), //sun
       ); 
    }
    
    
    /**
     * Checks that generatemonth returns array of arrays with correct keys
     * 
     * @covers Month::generatemonth
     */
    public function testGenerateMonth() {
        $month = new Month(6,2014);
        
        $result = $month->generatemonth();
        
        $this->assertArrayHasKey('day',$result[0]);
        $this->assertArrayHasKey('date',$result[0]);
        $this->assertArrayHasKey('type',$result[0]);
    }
    
}
