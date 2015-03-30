<?php
/**
 * Created by PhpStorm.
 * User: nishant
 * Date: 25/3/15
 * Time: 3:23 PM
 */
$ui = new UI();

$test_row = $ui->row()->classes('modal fade')->id('cancel_dialog_fade')->open();
$test_col = $ui->col()->classes('modal-dialog')->id('cancel_dialog_dialog')->open();
$test_box = $ui->box()->classes('modal-content')->id('cancel_dialog_content')->open();

?>
<div class="modal-header">
    <h2>Station Leave Cancellation Conformation </h2>
</div>
<div class="modal-body">
    <?php
    $ui->alert()->title('<h2>Are You Sure You Want to Cancel Your Leave<h2>')->id('alert_tab_cancel')->uiType('danger')->show();
    $ui->alert()->title('Cancellation Request Successfully Forwarded to corresponding Employee')->uiType('success')
        ->id('cancellation_success')->show();


    //    $row2 = $ui->row()->id('next_emp_id')->open();
    //    $col_next_emp = $ui->col()->open();
    //    $box3 = $ui->box()
    //        ->title('Please Select Approving Employee')
    //        ->solid()
    //        ->id('approving_emp')
    //        ->uiType('primary')
    //        ->open();
    //    $inputRow4 = $ui->row()->open();
    //    $ui->select()
    //        ->label('Department Type')
    //        ->name('type')
    //        ->id('type')
    //        ->required()
    //        ->options(array($ui->option()->value('""')->text('Select')->selected(),
    //            $ui->option()->value('academic')->text('Academic'),
    //            $ui->option()->value('nonacademic')->text('Non Academic')))
    //        ->width(6)
    //        ->show();
    //    $ui->select()
    //        ->label('Select Department')
    //        ->name('department_name')
    //        ->id('department_name')
    //        ->required()
    //        ->options(array($ui->option()->value('""')->text('Select')))
    //        ->width(6)
    //        ->show();
    //    $inputRow4->close();
    //
    //    $inputRow5 = $ui->row()->open();
    //    $ui->select()
    //        ->label('Designation')
    //        ->name('designation')
    //        ->id('designation')
    //        ->required()
    //        ->options(array($ui->option()->value('""')->text('Select')))
    //        ->width(6)
    //        ->show();
    //    $ui->select()
    //        ->label('Employee Name')
    //        ->name('emp_name')
    //        ->id('emp_name')
    //        ->required()
    //        ->options(array($ui->option()->value('""')->text('Select')->selected()))
    //        ->width(6)
    //        ->show();
    //    $inputRow5->close();
    //    $box3->close();
    //    $col_next_emp->close();
    //    $row2->close();


    ?>
</div>
<div class="modal-footer">

    <?php
    $row_test = $ui->row()->id('cancel_button_tab')->open();
    $col_test = $ui->col()->width(6)->open();
    ?>
    <center>
        <?php
        $ui->button()->width(12)->id('dialog_cancel_yes')->name('dialog_cancel_yes')->uiType('danger')->value('YES')->show();
        ?>
    </center>
    <?php
    $col_test->close();
    $col_test1 = $ui->col()->width(6)->open();
    ?>
    <center>
        <?php
        $ui->button()->width(12)->id('dialog_cancel_no')->name('dialog_cancel_no')->uiType('success')->value('NO')->show();
        ?>
    </center>
    <?php
    $col_test1->close();
    $row_test->close();
    $row_test1 = $ui->row()->id('cancel_confirm_button')->open();

    ?>
    <center>
        <?php
        $ui->button()->width(12)->id('cancel_cnf_button')->name('cancel_cnf_button')->uiType('success')->value('SUBMIT')->show();
        ?>
    </center>
    <?php

    $row_test1->close();

    $row_test1 = $ui->row()->id('cancel_confirm_button')->open();

    ?>
    <center>
        <?php
        $ui->button()->width(12)->id('redirect_button')->name('redirect_button')->uiType('success')->value('CLOSE')->show();
        ?>
    </center>
    <?php

    $row_test1->close();
    ?>
</div>
<?php
$test_box->close();
$test_col->close();
$test_row->close();

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
        <center>Status</center>
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
        $number = $i + 1;
        $emp_id = $data[$i]['emp_id'];
        $apl_date = $data[$i]['applying_date'];
        $st_lv_date = $data[$i]['leaving_date'];
        $st_lv_time = $data[$i]['leaving_time'];
        $st_ar_date = $data[$i]['arrival_date'];
        $st_ar_time = $data[$i]['arrival_time'];
        $period = $data[$i]['period'];
        $purpose = $data[$i]['purpose'];
        $addr = $data[$i]['addr'];
        $leave_id = $data[$i]['id'];
        $leave_st = $data[$i]['status'];
        $i++;
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
        ?>
        <tr>
            <td>
                <center>
                    <?php echo $number; ?>
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
                <center>
                    <?php echo $leave_status; ?>
                </center>
            </td>
            <td>
                <?php
                $inputRow = $ui->row()->open();
                $column1 = $ui->col()->width(4)->open();
                ?>
                <center>

                    <?php
                    $btn_string = 'onclick=' . '"clickEvent(' . $leave_id . ',' . $emp_id . ')"';
                    $ui->button()->id('st_submit')->extras($btn_string)->width(4)->uiType('danger')->name('station_leave_cancel')->value('Cancel Leave')->show();
                    ?>
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
<script charset="utf-8">
    var id, emp;
    var wt_cancel = '<?php echo Leave_constants::$WAITING_CANCELLATION?>';
    var cancelled = '<?php echo Leave_constants::$CANCELED?>';
    var rfr = '<?php echo site_url('leave/leave_station/cancelStationLeave')?>';
    $(document).ready(function () {
        $('#cancel_dialog_fade').hide();
        $('#next_emp_id').hide();
        $('#cancel_cnf_button').hide();
        $('#cancellation_success').hide();
        $('#redirect_button').hide();
        $('#dialog_cancel_yes').on('click', function () {
//            $('#alert_tab_cancel').hide();
//            $('#cancel_button_tab').hide();
//            $('#next_emp_id').show();
//            $('#cancel_cnf_button').show();
            $.ajax({
                url: site_url("leave/leave_station/insert_station_leave_status/" + id + "/" + emp + "/" + emp + "/" + cancelled),
                success: function (result) {
                    $('#').html(result);
                }
            });
            window.location = rfr;
        });
        $('#cancel_cnf_button').on('click', function () {
            $.ajax({
                url: site_url("leave/leave_station/insert_station_leave_status/" + id + "/" + emp + "/" + $('#emp_name').val() + "/" + wt_cancel),
                success: function (result) {
                    $('#').html(result);
                }
            });
            $('#next_emp_id').hide();
            $('#alert_tab_cancel').hide();
            $('#cancel_cnf_button').hide();
            $('#cancellation_success').show();
            $('#redirect_button').show();
        });
        $('#redirect_button').on('click', function () {
            window.location = rfr;
        });
        $('#dialog_cancel_no').on('click', function () {
            window.location = rfr;
        });
    });
    function clickEvent(leave_id, emp_id) {
        id = leave_id;
        emp = emp_id;
        $("#cancel_dialog_fade").modal('show');
    }
</script>