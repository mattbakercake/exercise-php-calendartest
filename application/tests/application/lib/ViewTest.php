<?php
/**
 * Description of testView
 *
 * @author Matt
 */
class ViewTest extends PHPUnit_Framework_TestCase {
   
    /*
     * Checks that stored month is integer
     * 
     * @covers View::getMonth
     */
    public function testMonthTypeAndVal() {
        $view = new View();
        $month = $view->getMonth();
        $expected = (int)date('n'); //currrent month in format n e.g. 1 or 10
        
        $this->assertSame($expected,$month);
    }
    
    /*
     * Checks that stored year is integer
     * 
     * @covers View::getYear
     */
    public function testYearTypeAndVal() {
        $view = new View();
        $year = $view->getYear();
        $expected = (int)date('Y'); //currrent year in format YYYY e.g. 2014
        
        $this->assertSame($expected,$year);
    }
    
    /**
     * Checks that an int is returned for month getter function when
     * setting month with a string rather than required int (invalid
     * input will default to current month integer)
     * 
     * @covers View::setMonth
     */
    public function testSetMonthReturnsInt() {
        $view = new View();
        $view->setMonth('1');
        
        $this->assertInternalType('int', $view->getMonth()); //check int returned
        
        $date = new DateTime;
         
        $this->assertSame((int)$date->format('n'),$view->getMonth()); //asserts returnedint is current month
        
    }
    
    /**
     * Checks that an int is returned for year getter function when
     * setting year with a string rather than required int (invalid
     * input will default to current year integer)
     * 
     * @covers View::setYear
     */
    public function testSetYearReturnsInt() {
        $view = new View();
        $view->setYear('2012');
        
        $this->assertInternalType('int', $view->getYear()); //check int returned
        
        $date = new DateTime;
         
        $this->assertSame((int)$date->format('Y'),$view->getYear()); //asserts returnedint is current Year
        
    }
    
    /**
     * Checks that the correctly formatted display month is returned for
     * current month
     * 
     * @covers View::getDisplayMonth
     */
    public function testGetDisplayMonthValid() {
        $view = new View();
        $displaymonth = $view->getDisplayMonth();
        
        $date = new DateTime;
        
        $this->assertSame($date->format('F'), $displaymonth); //displayMonth returns textuaral value for current month
    }
    
    /**
     * Checks the index function sets an array of date arrays in $this->cal
     * 
     * @covers View::index
     */
    public function testIndexSetsArray() {
        $view = new View();
        $view->index();
        
        $this->assertInternalType('array',$view->cal); //class property is array
        $this->assertGreaterThan(0,count($view->cal)); //array isn't empty
        $this->assertArrayHasKey('day', $view->cal[count($view->cal) -1]); //last sub-array has key
        $this->assertArrayHasKey('date', $view->cal[count($view->cal) -1]); //last sub-array has key
        $this->assertArrayHasKey('type', $view->cal[count($view->cal) -1]); //last sub-array has key  
    }   
    
    /**
     * Checks selectYears function returns array of option statements
     * 
     * @covers View::selectYears
     */
    public function testSelectYearsReturnsArray() {
        $view = new View();
        $years = $view->selectYears();
        $this->assertInternalType('array',$years); //is array
        $this->assertEquals(11,count($years)); //array has 11 keys - 1 yr back/10 forward
    }
    
    /**
     * Checks function returns an array of option statements
     * 
     * @covers View::selectMonths
     */
    public function testSelectMonthsReturnsArray() {
        $view = new View();
        $months = $view->selectMonths();
        $this->assertInternalType('array',$months); //is array
        $this->assertEquals(12,count($months)); //array has 12 keys
    }
    
}
