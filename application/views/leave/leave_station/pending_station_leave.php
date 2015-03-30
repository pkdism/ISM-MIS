<?php
/**
 * Created by PhpStorm.
 * User: nishant
 * Date: 25/3/15
 * Time: 3:23 PM
 */
$ui = new UI();
$row = $ui->row()->open();
$column = $ui->col()->width(12)->open();
$box = $ui->box()->uiType('primary')->id('Leave_test')->solid()->open();

//        $form =$ui->form()->action('leave/leave_station/pendingStationLeaveStatus')->open();
$table = $ui->table()->hover()->bordered()->sortable()->searchable()->paginated()->open();
?>
    <thead>
    <tr>
        <td>
            <center>Sl-No.</center>
        </td>
        <td>
            <center>Employee Name</center>
        </td>
        <td>
            <center>Applying Date</center>
        </td>
        <td>
            <center>Station Leaving Date</center>
        </td>
        <td>
            <center>Station Leaving Time</center>
        </td>
        <td>
            <center>Station Arriving Date</center>
        </td>
        <td>
            <center>Station Arriving Time</center>
        </td>
        <td>
            <center>Period</center>
        </td>
        <td>
            <center>Purpose</center>
        </td>
        <td>
            <center>Address</center>
        </td>
        <td>
            <center>Action</center>
        </td>
    </tr>
    </thead>
<?php
$i = 0;
if ($data == NULL) {
    $row5 = $ui->row()->open();
    $ui->alert()
        ->uiType('danger')
        ->title('Alert')
        ->desc('No Leaves To display')
        ->show();
    $row5->close();
} else {
    foreach ($data as $row) {
        $type = $data[$i]['type'];
        if ($type == Leave_constants::$WAITING_CANCELLATION) {
            $dsp_string = "Leave Cancellation Request";
            $ui_type = "info";
            $rqst_type = Leave_constants::$WAITING_CANCELLATION;
        } else {
            $dsp_string = "Approve/Cancel/Forward";
            $ui_type = "primary";
            $rqst_type = Leave_constants::$PENDING;
        }
        $number = $i + 1;
        $emp_id = $data[$i]['emp_id'];
        $name = $data[$i]['name'];
        $apl_date = $data[$i]['apl_date'];
        $st_lv_date = $data[$i]['lv_date'];
        $st_lv_time = $data[$i]['lv_time'];
        $st_ar_date = $data[$i]['rt_date'];
        $st_ar_time = $data[$i]['rt_time'];
        $period = $data[$i]['period'];
        $purpose = $data[$i]['purpose'];
        $addr = $data[$i]['addr'];
        $cur_user = $data[$i]['crt_emp'];
        $leave_id = $data[$i]['leave_id'];
        $i++;
        ?>
        <tr>
            <td>
                <center>
                    <?php echo $number; ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $name; ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $apl_date; ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $st_lv_date; ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $st_lv_time; ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $st_ar_date; ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $st_ar_time; ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $period; ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $purpose; ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $addr; ?>
                </center>
            </td>
            <td>
                <?php
                $inputRow = $ui->row()->open();
                $column1 = $ui->col()->width(4)->open();
                ?>
                <center>
                    <a href="<?php echo site_url("leave/leave_station/station_leave_approve/" . $leave_id . "/" . $cur_user . "/" . $emp_id . "/" . $rqst_type); ?>">
                        <?php
                        $ui->button()->id('st_submit')->width(4)->uiType($ui_type)->name('approve')->value($dsp_string)->show();
                        ?>
                    </a>
                </center>
                <?php
                $column1->close();
                $inputRow->close();
                ?>
            </td>
        </tr>
    <?php
    }
}
$table->close();
//        $form->close();
$box->close();
$column->close();
?>