<?php
/**
 * Month class provides interface to calendar month operations
 *
 * @author Matt
 */
class Month {
    
    private $_month;
    private $_year;
    
    public function __construct($month=NULL, $year=NULL) {
        $this->_month = $month;
        $this->_year = $year;
    }
    
    /**
     * returns number of days in given month/year
     * 
     * @return int
     */
    public function days($month=NULL,$year=NULL) {
        if (!is_int($month) && !is_int($year)) {
            $month = $this->_month;
            $year = $this->_year;
        }
        return cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year);
    }
    
    /**
     * returns int representing day of the first of month
     * 
     * 0 - sun
     * 1 - mon
     * 2 - tue
     * 3 - wed
     * 4 - thu
     * 5 - fri
     * 6 - sat
     * 
     * @return int
     */
    public function firstday() {
        $date = $this->_year . '-' . $this->_month . '-01';
        return date('w',  strtotime($date));
    }
    
    /**
     * returns int representing day of the last of month
     * 
     * 0 - sun
     * 1 - mon
     * 2 - tue
     * 3 - wed
     * 4 - thu
     * 5 - fri
     * 6 - sat
     * 
     * @return int
     */
    public function lastday() {
        $days = $this->days();
        $date = $this->_year . '-' . $this->_month . '-' .$days;
        return date('w',  strtotime($date));
    }
    
    /**
     * returns 2-dimensional array of padded month data
     * array(
     *  array('day'=>1,'date'=>31,'type'=>'padding'),
     *  array('day'=>2,'date'=>1,'type'=>'core'),
     *  .......
     * )
     * @return array 
     */
    public function generatemonth() {
        $firstday = $this->firstday();//first day (int) of requested month
        $lastday = $this->lastday();//last day (int) of requested month
        $numdays = $this->days();//how many days in requested month
        
        $lastmonth = ($this->_month -1 === 0) ? 12 : $this->_month -1;
        $lastnumdays = $this->days($lastmonth,$this->_year);//how many days previous month
        
        $prearray = $this->generateprepad($lastnumdays, $firstday); //get prepad days
        
        $postarray = $this->generatepostpad($lastday); //get postpad days
            
        $corearray = $this->generatecore($numdays, $firstday);//get core dates
        
        
        return array_merge($prearray,$corearray,$postarray); //join arrays
    }
    
    /**
     * returns 2-dimensional array of pre-pad dates
     * array(
     *  array('day'=>1,'date'=>30,'type'=>'padding'),
     *  array('day'=>2,'date'=>31,'type'=>'padding'),
     *  .......
     * )
     * @return array 
     */
    private function generateprepad($lastnumdays,$firstday) {
        $days = ($firstday - 1 === -1 ? 6 : $firstday -1); //how many days to pre pad
        if ($days > 0) { //if prepad days required
            $lastday = $firstday -1; //get day (int) prior to 1st of month
            $count = 0;
            $array = array();
            /* for the number of pre pad days required */
            while($count < $days) {
                if ($lastday === -1) { //reset the day int after sunday (0)
                    $lastday = 6;
                }
                array_push($array, array('day'=>$lastday ,'date'=>$lastnumdays, 'type'=>'padding'));

                $count++;
                $lastnumdays--;
                $lastday--;
            }

            return array_reverse($array);
        } else {
            return array(); //no days return empty array
        }
    }
    
    /**
     * returns 2-dimensional array of post-pad dates
     * array(
     *  array('day'=>6,'date'=>1,'type'=>'padding'),
     *  array('day'=>0,'date'=>2,'type'=>'padding'),
     *  .......
     * )
     * @return array 
     */
    private function generatepostpad($lastday) {
        $days = 7 - $lastday;//how many days to post pad
        if ($days > 0 && $days < 7) { //if postpad days to add
            $firstday = $lastday + 1; //get the day (int) after the last day of month
            $count = 1;  //start on 1st of next month
            $array = array();
            /* for each post pad days required*/
            while ($count <= $days) {
                if ($firstday > 6) { //reset days back to sun (0) when sat(6) reached
                    $firstday = 0;
                }
                array_push($array, array('day'=>$firstday ,'date'=>$count ,'type'=>'padding'));

                $count++;
                $firstday++;
            }
            return $array;
        } else {
            return array(); //no days return empty array
        }
     
    }
    
    /**
     * returns 2-dimensional array of core month dates
     * array(
     *  array('day'=>6,'date'=>1,'type'=>'core'),
     *  array('day'=>0,'date'=>2,'type'=>'core'),
     *  .......
     * )
     * @return array 
     */
    private function generatecore($numdays,$firstday) {
        $count = 1; //start on first of month
        $array = array();
        /* for the number of days in month */
        while ($count <= $numdays) {
            $firstday = ($firstday > 6 ? 0 : $firstday); //reset day int at end of week 
            array_push($array, array('day'=>$firstday ,'date'=>$count ,'type'=>'core'));
            
            $count++;
            $firstday++;
        }
        
        return $array;
        
    }
        
}
