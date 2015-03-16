<?php
	foreach($employees as $row)
	{
	   echo '<option value="'.$row->id.'">'.$row->id.'</option>';
	}
?>