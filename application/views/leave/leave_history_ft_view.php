
<?php
/*
 * Author :- Nishant Raj
 */
    $ui =  new UI();    
    
    $column2 = $ui->col()->width(12)->open();
        $box =  $ui->box()
               ->title('Leave Balance')
                ->solid()	
                ->uiType('primary')
		->open();
            
            $table = $ui->table()->hover()->bordered()->open();
?>
            <tr>
                <th>Leave Type</th>
                <th>Leave Balance</th>
            </tr>
            <tr>
                <td>Casual Leave</td>
                <td><?php echo $Casual_balance; ?></td>
            </tr>
            <tr>
                <td>Restricted Leave</td>
                <td><?php echo $Restricted_balance; ?></td>
            </tr>
                          
<?php   
        $table->close();
        $box->close();
?>
<?php
        $tabBox1 = $ui->tabBox()
                    ->title('Leave Details')
                    ->tab("casual_leave", "Casual Leave", true)
                    ->tab("restricted_leave", "Restricted Leave",false)
                    ->open();
        $tab1 = $ui->tabPane()->id("casual_leave")->active()->open();
        $table1 = $ui->table()->hover()->bordered()->sortable()->searchable()->paginated()->open();
?>
            <thead>
                <tr>
                    <th><center>Leave Number</center></th>
                    <th><center>Leave Type</center></th>
                    <th><center>Leave Applied Date</center></th>
                    <th><center>Start Date</center></th>
                    <th><center>End Date</center></th>
                    <th><center>Period</center></th>
                    <th><center>Half/Full</center></th>
                    <th><center>Before Noon/After Noon</center></th>
                    <th><center>Leave Status</center></th>
                </tr>
            </thead>
            <?php
                $all = "";
                $cnt = 1;
                foreach($leave_history_casual as $row){
                    $leave_type = $row['type'];
                    $leave_applied_date = $row['date_applied'];
                    $leave_start_date = $row['leave_start_date'];
                    $leave_end_date = $row['leave_end_date'];
                    $leave_period = $row['period'];
                    $leave_half = $row['j_noon'];
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
                    $leave_st = $row['status'];
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
                    else if ($leave_st == Leave_constants::$REJECTED) {
                        $rej = "label label-danger";
                        $str = "<label class='$rej'>"."REJECTED"."</label>";
                        $leave_status = $str;
                    }
                    else if ($leave_st == Leave_constants::$WAITING_CANCELLATION) {
                        $waitc = "label label-info";
                        $str = "<label class='$waitc'>"."WAITING CANCELLATION"."</label>";
                        $leave_status = $str;
                    }
                    $hold = "<tr><td><center>$cnt</center></td>"
                            . "<td><center>$leave_type</center></td>"
                            . "<td><center>$leave_applied_date</center></td>"
                            . "<td><center>$leave_start_date</center></td>"
                            . "<td><center>$leave_end_date</center></td>"
                            . "<td><center>$leave_period</center></td>"
                            . "<td><center>$leave_half_type</center></td>"
                            . "<td><center>$leave_half_noon</center></td>"
                            . "<td><center>$leave_status</center></td></tr>";
                    $all .= $hold;
                    $cnt++;
                }
                echo $all;
                $table1->close();
                $tab1->close();
 ?>
            <?php
            $tab2 = $ui->tabPane()->id("restricted_leave")->open();
            $table2 = $ui->table()->hover()->bordered()->sortable()->searchable()->paginated()->open();
            ?>
            <thead>
                <tr>
                    <th>Leave Number</th>
                    <th>Leave Type</th>
                    <th>Leave Applied Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Leave Status</th>
                </tr>
            </thead>
            <?php
            $all="";
            $cnt = 1;
                foreach($leave_history_restricted as $row){
                    $leave_id = $row['id'];
                    $leave_type = $row['type'];
                    $leave_applied_date = $row['date_applied'];
                    $leave_start_date = $row['leave_date'];
                    $leave_end_date = $row['leave_date'];
                    $leave_st = $row['status'];
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
                    else if ($leave_st == Leave_constants::$REJECTED) {
                        $rej = "label label-danger";
                        $str = "<label class='$rej'>"."REJECTED"."</label>";
                        $leave_status = $str;
                    }
                    else if ($leave_st == Leave_constants::$WAITING_CANCELLATION) {
                        $waitc = "label label-info";
                        $str = "<label class='$waitc'>"."WAITING CANCELLATION"."</label>";
                        $leave_status = $str;
                    }
                    $hold = "<tr><td>$cnt</td>"
                            . "<td>$leave_type</td>"
                            . "<td>$leave_applied_date</td>"
                            . "<td>$leave_start_date</td>"
                            . "<td>$leave_end_date</td>"
                            . "<td>$leave_status</td></tr>";
                    $all .= $hold;
                }
                echo $all;
            ?>
<?php    
        $table2->close();
        $tabBox1->close();
?>



