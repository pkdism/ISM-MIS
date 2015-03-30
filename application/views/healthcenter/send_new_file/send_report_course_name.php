<option type="text" value="">Select</option>
<?php
	if($result)
	{
	foreach($result as $row)
	{
?>
		<option type="text" value="<?php echo $row->s-id; ?>" ><?php echo $row->s_name; ?></option>
<?php
	}
	}
	else
	{
		?>
		<option type="text" value="">No Supplier Found</option>
		<?php
	}
	
?>
