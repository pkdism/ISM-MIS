<?php

	// Ajax giving Employee name options of a particular department

	if($empNames === FALSE)
        echo '<option value="" disabled="disabled">No Employee found</option>';
    else
    {
    	echo '<option disabled="disabled" selected="selected">Select Employee</option>';
        foreach($empNames as $row)
        {
            echo '<option value="'.$row->id.'">'.ucwords($row->salutation).'. '.ucwords($row->first_name).' '.ucwords($row->last_name).' ('.$row->id.')</option>';
        }
    }
?>

