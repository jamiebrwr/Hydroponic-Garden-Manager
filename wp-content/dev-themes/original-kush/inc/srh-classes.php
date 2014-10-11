<?php
class srhTime {
   	public $_chart_value;
    public $_pickup_hour;
    public $_pickup_minute;
    public $_drop_off_hour;
    public $_drop_off_minute;
    public $_update_pickup_hour;
    public $_update_pickup_minute;
    public $_update_drop_off_hour;
    public $_update_drop_off_minute;
    public $_final_time_value;
    public $_formatted_timestamp_pickup_time;
    public $_timestamp_drop_off_time;
    public $_twelve_formatted_timestamp_drop_off_time;
 
    public function __construct($chart_value, $pickup_hour, $pickup_minute, $drop_off_hour, $drop_off_minute, $update_pickup_hour, $update_pickup_minute, $update_drop_off_hour, $update_drop_off_minute, $final_time_value, $formatted_timestamp_pickup_time, $timestamp_drop_off_time)
    	{
        $this->_chart_value = $chart_value;
        $this->_pickup_hour = $pickup_hour;
        $this->_pickup_minute = $pickup_minute;
        $this->_drop_off_hour = $drop_off_hour;
        $this->_drop_off_minute = $drop_off_minute;
        $this->_update_pickup_hour = $update_pickup_hour;
        $this->_update_pickup_minute = $update_pickup_minute;
        $this->_update_drop_off_hour = $update_drop_off_hour;
        $this->_update_drop_off_minute = $update_drop_off_minute;
        $this->_final_time_value = $final_time_value;
        $this->_getTwelveHourPickUp = $getTwelveHourPickUp;
        $this->_timestamp_drop_off_time = $timestamp_drop_off_time;
        
    }
    
    public function setProperty()
    	{
        
	    $formatted_pickup_time = sprintf("%02d:%02d", $this->_pickup_hour, $this->_pickup_minute);
	    
	    
/*
echo'<pre> formatted_pickup_time ';
var_dump($formatted_pickup_time);
echo'</pre>';
*/	    
	    
	    
		$formatted_drop_off_time = sprintf("%02d:%02d", $this->_drop_off_hour, $this->_drop_off_minute);
		
		
/*
echo'<pre> formatted_drop_off_time ';
var_dump($formatted_drop_off_time);
echo'</pre>';
*/

		
		/* FORMAT STRINGS AS UNIX TIMESTAMPS */
		$timestamp_pickup_time = strtotime($formatted_pickup_time);
		
		
/*
echo'<pre> timestamp_pickup_time ';
var_dump($timestamp_pickup_time);
echo'</pre>';
*/
		
		
		$timestamp_drop_off_time = strtotime($formatted_drop_off_time);
		
		
/*
echo'<pre> timestamp_drop_off_time ';
var_dump($timestamp_drop_off_time);
echo'</pre>';	
*/	 

		//$formatted_timestamp_drop_off_time = date('g:i a',$timestamp_drop_off_time);
		
		$time_difference = human_time_diff( $timestamp_pickup_time, $timestamp_drop_off_time );
		
		
/*
echo'<pre> time_difference ';
var_dump($time_difference);
echo'</pre>';
*/
		
		$trimmed_time_difference = substr($time_difference, 0, -6);
		
		
/*
echo'<pre> trimmed_time_difference ';
var_dump($trimmed_time_difference);
echo'</pre>';
*/
		
		
		$calculated_time = $this->_chart_value - ($this->_chart_value - $trimmed_time_difference);
		
/*
echo'<pre> calculated_time ';
var_dump($calculated_time);
echo'</pre>';
*/
		
		$val = $calculated_time / $this->_chart_value;
		
/*
echo'<pre> val ';
var_dump($val);
echo'</pre>';
*/
		
		$newval = (float)$val * 100;


/*
echo'<pre> newval ';
var_dump($newval);
echo'</pre>';
*/
		
	
	    $this->_final_time_value = $newval;
	    return $this->_final_time_value . "<br />";
    }
	public function setTwelveHourPickup()
	    {
	    	$formatted_pickup_time = sprintf("%02d:%02d", $this->_pickup_hour, $this->_pickup_minute);
			
			/* FORMAT STRINGS AS UNIX TIMESTAMPS */
			$timestamp_pickup_time = strtotime($formatted_pickup_time);
		    
		    $timestamp_pickup_time;
	    }
	public function getTwelveHourPickUp()
	    {	$formatted_pickup_time = sprintf("%02d:%02d", $this->_pickup_hour, $this->_pickup_minute);
			
			/* FORMAT STRINGS AS UNIX TIMESTAMPS */
			$timestamp_pickup_time = strtotime($formatted_pickup_time);
		    return $timestamp_pickup_time;
	    }
	public function setTwelveHourDropOff()
	    {
	    	$formatted_pickup_time = sprintf("%02d:%02d", $this->_drop_off_hour, $this->_drop_off_minute);
			
			/* FORMAT STRINGS AS UNIX TIMESTAMPS */
			$timestamp_drop_off_time = strtotime($formatted_drop_off_time);
		    
		    $timestamp_drop_off_time;
	    }
	public function getTwelveHourDropOff()
	    {	
			$formatted_drop_off_time = sprintf("%02d:%02d", $this->_drop_off_hour, $this->_drop_off_minute);
			
			/* FORMAT STRINGS AS UNIX TIMESTAMPS */
			$timestamp_drop_off_time = strtotime($formatted_drop_off_time);
		    return $timestamp_drop_off_time;
	    }
	    
 
    public function getProperty()
    	{
        return $this->_final_time_value . "<br />";
    }
    public function changePickupHour($new_pickup_hour)
    	{
        $this->_pickup_hour = $new_pickup_hour;
    }
    public function changeDropOffHour($new_drop_off_hour)
    	{
        $this->_drop_off_hour = $new_drop_off_hour;
    }
    	
}