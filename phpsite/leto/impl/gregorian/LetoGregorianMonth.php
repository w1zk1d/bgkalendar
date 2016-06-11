<?php

class LetoGregorianMonth extends LetoPeriodStructureBean {
    
    private $mIndexInYear = 0;
    
    private static $DEFAULT_LOCALE = "bg";
    private static $sLocaleMonthNames = array(
         "bg" => array("Януари",  "Февруари", "Март",      "Април",    "Май",      "Юни",
                       "Юли",     "Август",   "Септември", "Октомври", "Ноември",  "Декември"),
         "en" => array("January", "February", "March",     "April",    "May",       "June",
                       "July",    "August",   "September", "October",  "November", "December")
    );
    
        
        
    
    /**
     * Create new Month representation objec that would be able to return the name ofthe month based on its index 
     * within the year and the target locale.
     * @param totalLengthInDays
     * @param subPeriods
     * @param indexInYear Index of the month withing the year, starting from 0. Zero is for January. 1 is for February.
     *        11 is for December.
     */
    public function __construct($totalLengthInDays, $subPeriods, $indexInYear) 
    {
        parent::__construct($totalLengthInDays, $subPeriods);

        $this->mIndexInYear = $indexInYear;
        if ($this->mIndexInYear < 0 || $this->mIndexInYear >= 12) {
            throw new LetoExceptionUnrecoverable("No month with index " . $indexInYear 
                   . " is supported in Gregorian calendar. Its index shoul be between 0 (January) and 11 (December).");
        }
    }
    
    
    /**
     * Create new Month representation objec that would be able to return the name ofthe month based on its index 
     * within the year and the target locale.
     * @param totalLengthInDays
     * @param subPeriods
     * @param indexInYear Index of the month withing the year, starting from 0. Zero is for January. 1 is for February.
     *        11 is for December.
     */
    public function __construct1($bean, $indexInYear) 
    {
        __construct($bean->getTotalLengthInDays(), $bean->getSubPeriods(), $indexInYear);
    }
    
    public function getName($locale = "bg") {
        $months = null;
        if ($locale != null) {
            $months = LetoGregorianMonth::$sLocaleMonthNames[$locale];
        }
        return $months[$this->mIndexInYear];
    }
}
?>
