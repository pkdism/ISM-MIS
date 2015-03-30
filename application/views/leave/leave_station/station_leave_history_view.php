<?php
/**
 * Created by PhpStorm.
 * User: nishant
 * Date: 24/3/15
 * Time: 9:04 PM
 */
$ui = new UI();
$row = $ui->row()->open();
$column = $ui->col()->width(12)->open();
$box = $ui->box()->title('Station Leave History')->uiType('primary')->solid()->open();
$table = $ui->table()->hover()->bordered()->sortable()->searchable()->paginated()->open();
?>
    <thead>
    <tr>
        <th>
            <center>Number</center>
        </th>
        <th>
            <center>Station Leaving Date</center>
        </th>
        <th>
            <center>Station Leaving Time</center>
        </th>
        <th>
            <center>Station Returning Date</center>
        </th>
        <th>
            <center>Station Returning Time</center>
        </th>
        <th>
            <center>Period</center>
        </th>
        <th>
            <center>Purpose</center>
        </th>
        <th>
            <center>Address During Absence</center>
        </th>
        <th>
            <center>Pending At</center>
        </th>
        <th>
            <center>Status</center>
        </th>
    </tr>
    </thead>
<?php
$i = 0;
if ($data != NULL)
    foreach ($data as $row) {

        $st_lv_date = $data[$i]['leaving_date'];
        $st_lv_time = $data[$i]['leaving_time'];
        $st_rt_date = $data[$i]['arrival_date'];
        $st_rt_time = $data[$i]['arrival_time'];
        $period = $data[$i]['period'];
        $purpose = $data[$i]['purpose'];
        $addr = $data[$i]['addr'];
        $leave_status = $data[$i]['status'];
        $leave_st = $data[$i]['status'];
        if ($leave_st == Leave_constants::$PENDING || $leave_st == Leave_constants::$FORWARDED) {
            $pending_at = $data[$i]['fwd_to'];
        } else
            $pending_at = "-";

        if ($leave_st == Leave_constants::$APPROVED) {
            $success = "label label-success";
            $str = "<label class='$success'>" . "APPROVED" . "</label>";
            $leave_status = $str;
        } else if ($leave_st == Leave_constants::$CANCELED) {
            $cncl = "label label-warning";
            $str = "<label class='$cncl'>" . "CANCELED" . "</label>";
            $leave_status = $str;
        } else if ($leave_st == Leave_constants::$PENDING) {
            $pnd = "label label-info";
            $str = "<label class='$pnd'>" . "PENDING" . "</label>";
            $leave_status = $str;
        } else if ($leave_st == Leave_constants::$REJECTED) {
            $rej = "label label-danger";
            $str = "<label class='$rej'>" . "REJECTED" . "</label>";
            $leave_status = $str;
        } else if ($leave_st == Leave_constants::$WAITING_CANCELLATION) {
            $waitc = "label label-info";
            $str = "<label class='$waitc'>" . "WAITING CANCELLATION" . "</label>";
            $leave_status = $str;
        } else if ($leave_st == Leave_constants::$FORWARDED) {
            $waitc = "label label-info";
            $str = "<label class='$waitc'>" . "FORWARDED" . "</label>";
            $leave_status = $str;
        }
        $i++;
        echo "<tr><td><center>$i</center></td>"
            . "<td><center>$st_lv_date</center></td>"
            . "<td><center>$st_lv_time</center></td>"
            . "<td><center>$st_rt_date</center></td>"
            . "<td><center>$st_rt_time</center></td>"
            . "<td><center>$period</center></td>"
            . "<td><center>$purpose</center></td>"
            . "<td><center>$addr</center></td>"
            . "<td><center>$pending_at</center></td>"
            . "<td><center>$leave_status</center></td></tr>";

    }

$table->close();
$box->close();
$column->close();
?>