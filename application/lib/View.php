<?php
/**
 * View class provides view interface functions 
 *
 * @author Matt
 */
class View {
    
    private $_month; //current month
    private $_year; //current year
    public $cal; //generated calendar date array
    
    public function __construct() {
        if(isset($_POST['submit'])) { //form submitted
            $this->setYearMonth(
                    (int)filter_var($_POST['year'], FILTER_SANITIZE_NUMBER_INT), 
                    (int)filter_var($_POST['month'],FILTER_SANITIZE_NUMBER_INT)
            );
        } elseif(isset($_POST['prev'])) { //prev button pressed
            $this->setYearMonth(
                    (int)filter_var($_POST['currentyear'],FILTER_SANITIZE_STRING),
                    (int)filter_var($_POST['currentmonth'], FILTER_SANITIZE_STRING)
            );
            $this->incDecMonth("-1 Month");
        } elseif(isset($_POST['next'])) { //next button pressed
            $this->setYearMonth(
                    (int)filter_var($_POST['currentyear'],FILTER_SANITIZE_STRING), 
                    (int)filter_var($_POST['currentmonth'],FILTER_SANITIZE_STRING)
            );
            $this->incDecMonth("+1 Month");
        } else { //default behaviour
            $this->setYearMonth();
        }
    }
    
    /**
     * Sets current calendar month and year
     * 
     * @param int $year
     * @param int $month
     */
    private function setYearMonth($year=NULL,$month=NULL) {
        $this->setMonth($month);
        $this->setYear($year);
    }
    
    /**
     * Setter function for current calendar month
     * @param int $month
     */
    public function setMonth($month=NULL) {
        if ($month === NULL || !is_int($month)) { //if param isn't set or an int
            $date = new DateTime();
            $this->_month = (int)$date->format('n');  //set the current month
        } else {
            $this->_month = (int)$month;
        }
    }
    
    /**
     * getter function for current calendar month
     * @return int
     */
    public function getMonth() {
        return $this->_month;
    }
    
    public function getDisplayMonth() {
        $date = new DateTime($this->getYear() . "-" . $this->getMonth() . "-01");
        
        return $date->format('F');
    }
    
    /**
     * Setter function for current calendar year
     * @param int $year
     */
    public function setYear($year=NULL) {
        if ($year === NULL || !is_integer($year)) { //if param isn't set or an int
            $date = new DateTime();
            $this->_year = (int)$date->format('Y');  //set current year
        } else {
            $this->_year = (int)$year;
        }
    }
    
    /**
     * Getter function for current calendar year
     * @return int
     */
    public function getYear() {
        return $this->_year;
    }
    
    /**
     * stores array of dates for current calendar month view 
     */
    public function index() {
        $month = new Month($this->getMonth(),$this->getYear());
        $this->cal = $month->generatemonth();
    }
    
    /**
     * Generates array of Year <select></select> options for view form
     * @return array
     */
    public function selectYears() {
        $data = array();
        $date = new DateTime($this->getYear() . "-" . $this->getMonth() . "-" . "01"); //dateTime obj
        $date->modify("-1 Year"); //set date object to year - 1
        $year = (int)$date->format('Y');
        for ($i=0;$i<11;$i++) { //generate options for years
            $thisyear = $year+$i;
            $selected = ($this->getYear() === $thisyear) ? "selected='SELECTED'" : "" ;
            array_push($data, '<option value="' . $thisyear . '" ' . $selected . '>' . $thisyear . '</option>');
        }
        
        return $data;
    }
    
    /**
     * Generates array of Month <select></select> options for view form
     * @return array
     */
    public function selectMonths() {
        $data = array();
        for($i=1; $i<13; $i++) {//for each of 12 months
            $selected = ($this->getMonth() === $i) ? "selected='SELECTED'" : "" ; //auto-select current month
            
            $date = new DateTime($this->getYear() . "-" . $i . "-" . "01"); //dateTime obj for month
            
            array_push($data, '<option value="' . $i . '" ' . $selected . '>' . $date->format('F') . '</option>'); //generate option
        }
        
        return $data;
    }
    
    /**
     * Increments/Decrements the current month and year by string value $amount 
     * that is a valid PHP date/time format e.g. "+1 Month"
     * 
     * @param string $amount
     */
    private function incDecMonth($amount) {
        $date = new DateTime($this->getYear() . "-" . $this->getMonth() . "-" . "01"); //dateTime obj for month
        $date->modify($amount); //calculate new month
        
        //set month and year
        $this->setYearMonth((int)$date->format('Y'), (int)$date->format('n'));
    }
}
