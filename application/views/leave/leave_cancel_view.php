<?php
 $ui = new UI();
if (isset($is_notification_on) && $is_notification_on == TRUE) {
    
    // if notifications are on    
    if (isset($errors)) {
        $error_str = "";
        foreach($errors as $str) {
            $error_str .= $str.'<br>';
        }
        $ui->alert()
                    ->uiType('danger')
                    ->desc($error_str)
                    ->show();
    }
}

$ref_self = $_SERVER['PHP_SELF'];

$table_content = "";

if (isset($leaves)) {
    switch ($leave_type) {
        case 'Casual Leave':
            
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
            break;
        case 'Restricted Leave':
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
            break;
    }
}

?>
<?php
    
    $row = $ui->row()->open();
    
    $column1 = $ui->col()->width(3)->open();
    $column1->close();
    
    $column = $ui->col()->width(6)->open();
        $box = $ui->box()
                ->title('Select Leave Type')
                ->solid()
                ->uiType('primary')
                ->open();
        $form = $ui->form()->action('leave/leave_cancel')->open();
?>
            <div class="form-group col-md-10 col-lg-6">

                <select id="leave_type_cancle" name ="leave_type" class="form-control" required="required">
                        <option value="$">Select Leave Type</option>
                        <option value="Casual Leave">Casual Leave</option>
                        <option value="Restricted Leave">Restricted Leave</option>
                </select>
            </div>
    <center>
<?php
    $ui->button()
        ->type('submit1')
        ->value('Submit')
        ->submit(true)
        ->name('submit')
        ->uiType('primary')
        ->show();
?>
    </center>
<?php
    $form->close();
    $box->close();
    $column->close();
    $row->close();
    
?>
<?php
    if (!empty($table_content)) {
        $row1 = $ui->row()->open();
        $column3 = $ui->col()->width(1)->open();
        $column3->close();
        $column4 = $ui->col()->width(10)->open();
        $box = $ui->box()
                    ->title('Cancellable Leave')
                    ->solid()
                    ->uiType('primary')
                    ->open();
            $form = $ui->form()->action('leave/leave_cancel')->open();

            $table_cancel = $ui->table()->hover()->responsive()->sortable()->searchable()->paginated()->bordered()->open();
                echo $table_content;
            $table_cancel->close();
                $ui->button()
                    ->type('submit')
                    ->value('Cancel')
                    ->submit(true)
                    ->name('cancel')
                    ->uiType('primary')
                    ->show();
            $form->close();
        $box->close();
        $column4->close();
        $row1->close();
    }
?>

