<?php
	// if($courses === FALSE)
 //        echo '<option value="none" disabled="disabled">No department found</option>';
 //    else
 //        foreach($courses as $row)
 //        {
 //            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
 //        }
	$ui = new UI();
	$course_array = array();

    if($courses === FALSE)
    	$course_array[] = $ui->option()->value('none')->text('No Course');
    else
    	foreach ($courses as $row)
    	{
    		$course_array[] = $ui->option()->value($row->id)->text($row->name);
    		$course_array = array_values($course_array);
    	}

    $ui->select()
       ->width(4)
       ->label('Course')
       ->name('course')
       ->id('course_id')
       ->options($course_array)
       ->show();
?>