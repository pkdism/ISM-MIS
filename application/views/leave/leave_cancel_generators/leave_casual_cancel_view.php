<?php
/**
 * Created by PhpStorm.
 * User: samsidx
 * Date: 19/3/15
 * Time: 3:42 PM
 */

$table_hdr =
    "<thead><tr>"
    . "<td>Index</td>"
    . "<td>Start Date</td>"
    . "<td>End Date</td>"
    . "<td>Purpose</td>"
    . "<td>Period</td>"
    . "<td>Half/Full</td>"
    . "<td>Before Noon/After Noon</td>"
    . "<td>Status</td>"
    . "<td>Check</td>"
    . "</tr></thead>";
$table_content = $table_hdr;
$index = 1;

foreach($leaves as $leave) {
    $leave_id = $leave['id'];
    $leave_start_date = $leave['leave_start_date'];
    $leave_end_date = $leave['leave_end_date'];
    $leave_purpose = $leave['purpose'];
    $leave_st = $leave['status'];
    $leave_period = $leave['period'];
    $leave_st = $leave['status'];
    $leave_half = $leave['j_noon'];

    if($leave_half == 0){
        $leave_half_type = "FULL";
        $leave_half_noon = "-";
    }
    else if($leave_half == 1){
        $leave_half_type = "HALF";
        $leave_half_noon = "Before Noon";
    }
    else
    {
        $leave_half_type = "HALF";
        $leave_half_noon = "After Noon";
    }
    if($leave_st == Leave_constants::$APPROVED){
        $success = "label label-success";
        $str = "<label class='$success'>"."APPROVED"."</label>";
        $leave_status = $str;
    }
    else if($leave_st == Leave_constants::$CANCELED){
        $cncl = "label label-warning";
        $str = "<label class='$cncl'>"."CANCELED"."</label>";
        $leave_status = $str;
    }
    else if($leave_st == Leave_constants::$PENDING){
        $pnd = "label label-info";
        $str = "<label class='$pnd'>"."PENDING"."</label>";
        $leave_status = $str;
    }
    else{
        $rej = "label label-danger";
        $str = "<label class='$rej'>"."REJECTED"."</label>";
        $leave_status = $str;
    }
    $data_row = "<tr>"
        . "<td>$index</td>"
        . "<td>$leave_start_date</td>"
        . "<td>$leave_end_date</td>"
        . "<td>$leave_purpose</td>"
        . "<td>$leave_period</td>"
        . "<td>$leave_half_type</td>"
        . "<td>$leave_half_noon</td>"
        . "<td>$leave_status</td>"
        . "<td><input type='radio' name='leave_to_cancel' value='$leave_id'></td>"
        . "</tr>";
    $table_content .= $data_row;
    $index += 1;
}

echo $table_content;