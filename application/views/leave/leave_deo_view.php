
<?php

/*
 * Author : Nishant Raj
 */
$ui = new UI();

if(isset($is_error)){
    
    if($is_error == true){
        
        $ui->alert()
            ->uiType($error_type)
            ->desc($error_msg)
            ->show();
    }
}
$upper_row = $ui->row()->open();
$column_temp = $ui->col()->width(4)->open();
$column_temp->close();

$column = $ui->col()->width(4)->open();
    
    $form = $ui->form()->action('leave/leave_deo')->open();
    
        $box= $ui->box()
                ->title('Employee Details')
                ->uiType('primary')
                ->solid()
                ->open();
        $row = $ui->row()->open();
                $ui->input()->type('text')
                        ->placeholder($place_holder)
                        ->label('Employee id')
                        ->name('emp_id')
                        ->required()
                        ->width(12)
                        ->id('emp_id')     
                        ->show();
        $row->close();
?>
<center>
    <?php
    
        $row1 = $ui->row()->open();
        
        $ui->button()
            ->value('Submit')
            ->submit(true)
            ->name('submit')
            ->uiType('primary')
            ->show();
        $row1->close();
    ?>
</center>
<?php
        $box->close();
        $form->close();
        $column->close();
        $upper_row->close();
        
        if($post == true){
            $middle_row = $ui->row()->open();
            
                $column_left = $ui->col()->open();
  
                    echo '<center><img src="'.base_url().'assets/images/employee/'.$img_path.'"  height="150" /></center><br>';
                    
                    $table = $ui->table()->hover()->bordered()->open();
                    $name  = $this->employee_model->getNameById($emp->id);
                    $department=$this->departments_model->getDepartmentById($emp->dept_id)->name;
                    $designation=$this->designations_model->getDesignationById($emp->designation)->name;
                    
?>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $name; ?></td>
                            <th>Gender</th>
                            <td><?php echo ucwords($emp->sex); ?></td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td><?php echo date('d M Y', strtotime($emp->dob)); ?></td>
                            <th>Department</th>
                            <td><?php echo $department; ?></td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td><?php echo $designation; ?></td>
                            <th>Email</th>
                            <td><?php echo $emp->email; ?></td>
                        </tr>
                        <tr>
                            <th>Date of Joining</th>
                            <td><?php echo date('d M Y', strtotime($emp->joining_date)); ?></td>
                            <th>Mobile No.</th>
                            <td><?php echo $emp->mobile_no; ?></td>
                        </tr>

<?php
                            
                    $table->close();
                
                $column_left->close();
            
            $middle_row->close();
            
            $last_row = $ui->row()->open();
            
                $column5 = $ui->col()->width(2)->open();
                $column5->close();
                
                $form1 = $ui->form()->action('leave/leave_deo/index/'.$emp->id)->open();
                $column6 = $ui->col()->width(8)->open();
                    $box= $ui->box()
                            ->title('Enter Leave Balance')
                            ->uiType('primary')
                            ->solid()
                            ->open();
                    $row_1 = $ui->row()->open();
                        $column7 = $ui->col()->width(6)->open();
                            
                            $ui->input()->type('text')
                                        ->placeholder('Enter Casual Leave Balance')
                                        ->label('Casual Balance')
                                        ->name('casual_bal')
                                        ->required()
                                        ->width(12)
                                        ->id('casual_bal')     
                                        ->show();
                            
                        $column7->close();
                        
                        $column8 = $ui->col()->width(6)->open();
                        
                            $ui->input()->type('text')
                                        ->placeholder('Enter Restricted Leave Balance')
                                        ->label('Restricted Balance')
                                        ->name('restricted_bal')
                                        ->required()
                                        ->width(12)
                                        ->id('restricted_bal')     
                                        ->show();
                            
                        $column8->close();
                       ?>
                        <center>
                            <?php
                                $ui->button()
                                    ->value('Submit')
                                    ->submit(true)
                                    ->name('bal_details')
                                    ->uiType('primary')
                                    ->show();
                            ?>
                        </center>
                        <?php
                    $row_1->close();
                $column6->close();
                $form1->close();
            $last_row->close();
        }
?>