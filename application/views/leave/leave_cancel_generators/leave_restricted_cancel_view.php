<?php
/**
 * Created by PhpStorm.
 * User: samsidx
 * Date: 19/3/15
 * Time: 3:41 PM
 */
$table_hdr = "<tr>"
    . "<td>Index</td>"
    . "<td>Leave Date</td>"
    . "<td>Purpose</td>"
    . "<td>Status</td>"
    . "<td>Check</td>"
    . "</tr>";
$table_content = $table_hdr;
$index = 1;
foreach($leaves as $leave) {
    $leave_id = $leave['id'];
    $leave_date = $leave['leave_date'];
    $leave_purpose = $leave['purpose'];
    $leave_status = $leave['status'];
    if ($leave_status == 0) {
        $leave_status = "Approved";
    }
    else if ($leave_status == 2) {
        $leave_status = "Pending";
    }
    $data_row = "<tr>"
        . "<td>$index</td>"
        . "<td>$leave_date</td>"
        . "<td>$leave_purpose</td>"
        . "<td>$leave_status</td>"
        . "<td><input type='radio' name='leave_to_cancel' value='$leave_id'></td>"
        . "</tr>";
    $table_content .= $data_row;
    $index += 1;
}
echo $table_content;