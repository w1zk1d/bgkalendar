<?php 

/**
 * This is an abstract class that can be used as base (parent) for any leto (calendar) implementation. 
 * It offers some usefull utilities like calculating the current date given the number of days from the 
 * leto (calendar) EPOCH.
 * <br/>
 * In fact each instance of a class that inherits from LetoBase, is a representation of a given date.
 */
abstract class LetoBase implements Leto {
    
    
    /**
     * All inheriting classes should define the beginning of their calendar in days before the java EPOCH. 
     * @return The beginning of calendar in days before java EPOCH. (long)
     */
    public abstract function startOfCalendarInDaysBeforeJavaEpoch();
    
    /**
     * All inheriting classes should define the supported calendar period types. For example the Gregorian calendar 
     * would return day, month, year, century (a period of 100 years) and 400 years period.
     * @return An array of all of the supported period types sorted in increasing order. The smolest period first
     * (with lower index).(LetoPeriodType[]) 
     */
    public abstract function getCalendarPeriodTypes();
    
    /**
     * Calculate the exact period values for the today's date. In general this method will calculate how much days have
     * elapsed since Java epoch (1-st January 1970) an then add the days from the beginning of the calendar.
     * Based on that data it would try to split that amount of dates into periods and fill in a LetoPeriod array. 
     * The LetoPeriod array should have the exact same size as the array returned by getCalendarPeriodTypes(). 
     * @return The exact period values of the current today's date. (LetoPeriod[])
     * @throws LetoException If there is a problem during calculation or if the calendar internal structures are not 
     *     well defined. 
     */
    public function getToday() {
        $days = $this->startOfCalendarInDaysBeforeJavaEpoch();
        $secondsFromJavaEpoch = bcadd(time(), '7200');                     // Two hours ahead of GMT.     time+2*60*60   
        $secondsInDay = '86400';                                           // Millis in a day.            60 * 60 * 24
        $daysFromJavaEpoch = bcdiv($secondsFromJavaEpoch, $secondsInDay);  // How much complete days have passed since EPOCH
        $days = bcadd($days, $daysFromJavaEpoch); 
        
        return $this->calculateCalendarPeriods($days);
    }
    
    
    /**
     * Calculate the periods based on the number of days since the leto (calendar) EPOCH.
     * @param days Number of days since the calendar starts. (long)
     * @return The calculated array of periods. (LetoPeriod[])
     * @throws LetoException If there is some unrecoverable error while calculating the date.
     */
    public function calculateCalendarPeriods($days) {
        $types = $this->getCalendarPeriodTypes();
        if ($types == null || count($types) <= 0) {
            throw new LetoException("This calendar does not define any periods.");
        }
        $periods = array();
        $periodAbsoluteCounts = array();
        $periodsStartDay = array();
        $periodsStructures = array();
        
        for ($i =0; $i < count($types); $i++) {
            $periods[$types[$i]->getName()] = '0';           
            $periodAbsoluteCounts[$types[$i]->getName()] = '0';
            $periodsStartDay[$types[$i]->getName()] = '0';   
        }
        $currentType = $types[count($types) - 1];
        $structures = $currentType->getPossibleStructures();
        if ($structures == null || count($structures) <= 0) {
            throw new LetoException("This calendar does not define any structure for the period type \"" 
                  . $currentType->getName() . ", so it is not defined how long in days this period could be.");
        }
        if (count($structures) > 1) {
            throw new LetoException("The biggest possible period type \"" . $currentType->getName() 
                  . "\" in this calendar has " . count($structures) 
                  . " possible structures, but just one was expected. It is not defined which one should be used.");
        }
        
        $daysElapsed = '0';
        
        $structure = $structures[0];
        $value       = bcdiv($days,  $structure->getTotalLengthInDays(), 0); // / devide  with 0 digits avter decimal point
        $days        = bcmod($days,  $structure->getTotalLengthInDays());    // % modulus
        $daysElapsed = bcmul($value, $structure->getTotalLengthInDays());    // * multiply
        $this->increaseCount($periods, $structure, $value);
        $this->increaseAbsolutePeriodCounts($periodAbsoluteCounts, $structure, $value);
        $periodsStartDay[$structure->getPeriodType()->getName()] = $daysElapsed;
        $periodsStructures[$structure->getPeriodType()->getName()] = $structure;
        
        while (($structures = $structure->getSubPeriods() ) != null) {
            if (count($structures) <= 0) {
                break;
            }
            for ($i = 0; $i < count($structures); $i++) {
                $structure = $structures[$i];
                if (bccomp($structure->getTotalLengthInDays(), $days) > 0) {
                    $periodsStartDay[$structure->getPeriodType()->getName()] = $daysElapsed;
                    $periodsStructures[$structure->getPeriodType()->getName()] = $structure;
                    break;
                } else {
                    
                    $days        = bcsub($days, $structure->getTotalLengthInDays());
                    $daysElapsed = bcadd($daysElapsed, $structure->getTotalLengthInDays());
                    
                    $this->increaseCount($periods, $structure, 1);
                    $this->increaseAbsolutePeriodCounts($periodAbsoluteCounts, $structure, 1);
                }
            }
        }
        $reslt = array();
        for ($i = 0; $i < count($types); $i++) {
            $type = $types[$i];
            $countLong = $periods[$type->getName()];
            $count = 0;
            if ($countLong != null) {
                $count = $countLong;
            }
            $bean = new LetoPeriodBean();
            $bean->setNumber($count);
            $bean->setAbsoluteNumber($periodAbsoluteCounts[$type->getName()]);
            $bean->setType($type);
            $bean->setActualName($periodsStructures[$type->getName()]->getName("bg"));
            $bean->setStartAtDaysAfterEpoch($periodsStartDay[$type->getName()]);
            $bean->setStructure($periodsStructures[$type->getName()]);
            $reslt[$i] = $bean;
        }
        return $reslt;
    }
    
    private function increaseCount(&$periods, &$structure, $value) {
        $periodCount = $periods[$structure->getPeriodType()->getName()];
        if ($periodCount == null) {
            $periodCount = $value;
        } else {
            $periodCount = bcadd($periodCount, $value);
        }
        $periods[$structure->getPeriodType()->getName()] = $periodCount;
    }
    
    private function increaseAbsolutePeriodCounts(
                  &$periodAbsoluteCounts, &$structure, $value) 
    {
        $types = $this->getCalendarPeriodTypes();
        for ($j = 0; $j < count($types); $j++) { 
            $type = $types[$j];
            $totalCount = $structure->getTotalLengthInPeriodTypes($type);
            $sumLong = $periodAbsoluteCounts[$type->getName()];
            if ($sumLong == null) {
                $sumLong = $totalCount * $value;
            } else {
                $sumLong = bcadd($sumLong, bcmul($totalCount, $value));  // $sumLong + ($totalCount * $value)
            }
            $periodAbsoluteCounts[$type->getName()] = $sumLong;
        }
    }
    
    /**
     * Given the representation of the date by periods, this method calculates the number of days since the 
     * start of the calendar.
     * @param periods An array of periods. (etoPeriod[])
     * @return The number of days since the start of the calendar.(long)
     * @throws LetoException If there is some unrecoverable error during calculation.
     */
    protected function calculateDaysFromPeriods($periods) {
        $days = 0;
        $len = count($periods);
        for ($periodIndex = $len-1; $periodIndex >= 0; $periodIndex--) {
            $period = $periods[$periodIndex];
            $number = $period->getNumber();
            
            $structure = $period->getStructure();
            $totalLengthInDays = $structure->getTotalLengthInDays();
            
            $days += ($number * $totalLengthInDays); 
            
        }
        
        return $days;
    }
    
    public function checkCorrectness() {
        return LetoCorrectnessChecks::checkCorrectness(getCalendarPeriodTypes(), $this);
    }
}
?>
