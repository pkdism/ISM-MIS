<?php
	// if($branches === FALSE)
 //        echo '<option value="none" disabled="disabled">No department found</option>';
 //    else
 //        foreach($branches as $row)
 //        {
 //            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
 //        }
	$ui = new UI();
	$course_array = array();

    if($branches === FALSE)
    	$branch_array[] = $ui->option()->value('none')->text('No branch');
    else
    	foreach ($branches as $row)
    	{
    		$branch_array[] = $ui->option()->value($row->id)->text($row->name);
    		$branch_array = array_values($branch_array);
    	}

    $ui->select()
       ->width(4)
       ->label('branch')
       ->name('branch')
       ->id('branch_id')
       ->options($branch_array)
       ->show();
?>