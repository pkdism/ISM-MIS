<?php

	// Ajax giving designation options of a particular type

	if($designations === FALSE)
	        echo '<option value="" disabled="disabled">No Designation Type</option>';
	else
	        foreach($designations as $row)
	        {
	            echo '<option value="'.$row->id.'">'.ucwords($row->name).'</option>';
	        }
?>