<option type="text" value="">Select</option>
<?php
	
	foreach($result as $row)
	{
?>
		<option type="text" value="<?php echo $row->name; ?>" ><?php echo $row->name; ?></option>
<?php
	}
	
	
?>
