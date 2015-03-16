<?php

	// Ajax giving department options of a particular type

	if($departments === FALSE)
        echo '<option value="" disabled="disabled">No department found</option>';
    else
        foreach($departments as $row)
        {
            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
?>

