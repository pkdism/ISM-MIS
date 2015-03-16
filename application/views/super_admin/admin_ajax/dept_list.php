<?php
	foreach($departments as $row)
	{
	   echo '<option value="'.$row->id.'">'.$row->name.'</option>';
	}
?>