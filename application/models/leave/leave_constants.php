<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

class Leave_constants {
    
    // types of leaves
    static $TYPE_CASUAL_LEAVE = 'Casual Leave';
    static $TYPE_RESTRICTED_LEAVE = 'Restricted Leave';
    
    // status of leave
    static $APPROVED = 0;
    static $REJECTED = 1;
    static $PENDING = 2;
    static $CANCELED = 3;
    static $WAITING_CANCELLATION = 4;
    static $FORWARDED = 5;
    
    // tables of leaves
    static $TABLE_LEAVE_BASIC_INFO = 'leave_basic_info';
    static $TABLE_CASUAL_LEAVE = 'leave_casual';
    static $TABLE_RESTRICTED_LEAVE = 'leave_restricted';
    static $TABLE_LEAVE_STATUS = 'leave_status';
    static $TABLE_USER_DETAILS = 'user_details';
    static $TABLE_RESTRICTED_HOLIDAYS = 'restricted_holidays';
    static $TABLE_VACATION_DATES = 'vacation_dates';
    static $TABLE_STATION_LEAVE = 'leave_station_details';
    static $TABLE_STATION_LEAVE_STATUS = 'leave_station_status';
    // max, min vals of leaves
    static $MAX_CASUAL_LEAVES = 8;
    static $MAX_RESTRICTED_LEAVE = 2;
}

