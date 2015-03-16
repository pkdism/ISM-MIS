<option type="text" value="">Select</option>
<?php
	if($result)
	{
	foreach($result as $row)
	{
?>
		<option type="text" value="<?php echo $row->id; ?>" ><?php echo $row->name; ?></option>
<?php
	}
	}
	else
	{
		?>
		<option type="text" value="">No Branch Found</option>
		<?php
	}
	
?>
