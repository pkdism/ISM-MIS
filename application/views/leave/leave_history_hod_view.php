
<?php 


/*
 * Author : Nishant Raj
 */
$ui = new UI();
    if($notif == TRUE)
        $ui->alert()
                    ->uiType('danger')
                    ->desc($error)
                    ->show();
$ref_self = $_SERVER['PHP_SELF'] ; 
?>
<!--<form action="<?php echo $ref_self ?>" method="POST">-->
<?php
    $row = $ui->row()->open();
    
    $column1 = $ui->col()->width(2)->open();
    $column1->close();
    
    $column = $ui->col()->width(8)->open();
    
        $box = $ui->box()
                ->title('Select Employee and Leave Type')
                ->solid()
                ->uiType('primary')
                ->open();
        $form = $ui->form()->action('leave/leave_history')->open();
?>
            <div class="form-group col-md-12 col-lg-12">
                <label class="control-label" for="Employee_Name">Employee Name</label>

                <select id="emp_id" name ="emp_id" class="form-control" required="required">
                    <option value="$">--Please Select--</option>
                        <?php
                            $all = "";
                            foreach($users as $user){
                                $uid = $user['id'] ;
                                $salutation = $user['salutation'];
                                $f_name = $user['first_name'];
                                $m_name = $user['middle_name'];
                                $l_name = $user['last_name'];
                                $name1 = "$salutation "."$f_name "."$m_name "."$l_name";
                                $hold = "<option value='$uid'> $name1 </option>";
                                echo $hold;
                            }
                        ?>
                </select>
            </div>
<!--            <div class="form-group col-md-6 col-lg-6">
                <label class="control-label" for="Leave_Type">Leave Type</label>
                <select id ="leave_type" name ="leave_type" class="form-control" required="required">
                    <option value="$">--Please Select--</option>
                    <option value="Casual Leave">Casual Leave</option>
                    <option value="Restricted Leave">Restricted Leave</option>
                </select>      
            </div>-->
<center>
<?php
    $ui->button()
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
    
    $row2 = $ui->row()->open();
    
    
?>
<?php 
    if($set == TRUE){
        $str = "$name"."'s Leave Details";
        $stor = "content-header";
        $cen = "center";
        $res = "<section class='$stor'>"."<h1 align='$cen'>".$str."</h1></section>";
        echo "$res";
    }
?>
<?php
        $column_temp = $ui->col()->width(2)->open();
        $column_temp->close();
        $column2 = $ui->col()->width(8)->open();
        $box1 =  $ui->box()
               ->title('Leave Balance')
                ->solid()	
                ->uiType('primary')
		->open();
            $table = $ui->table()->hover()->responsive()->paginated()->bordered()->open();
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
                <td><?php echo $Resticted_balance ; ?></td>
            </tr>
                          
<?php   
        $table->close();
        $box1->close();
        $column2->close();
        $row2->close();
        
        $row3 =$ui->row()->open();
        $box2 = $ui->box()
                ->title('Leave History')
                ->solid()
                ->uiType('primary')
                ->open();
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
                $all = "";
                $cnt = 1;
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
                    $hold = "<tr><td><center>$cnt</center></td>"
                            . "<td><center>$leave_type</center></td>"
                            . "<td><center>$leave_applied_date</center></td>"
                            . "<td><center>$leave_start_date</center></td>"
                            . "<td><center>$leave_end_date</center></td>"
                            . "<td><center>$leave_status</center></td></tr>";
                    $all .= $hold;
                    $cnt++;
                }
                echo $all;
                $table2->close();
                $tab2->close();
                $tabBox1->close();
            ?>
<?php    
        $box2->close();
        $row3->close();
?>
