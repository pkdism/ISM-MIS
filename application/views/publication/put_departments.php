<option type="text" value="">Select</option>
<?php
//print_r($result);?>
	<?php
	foreach($result as $dept_array)
	{
?>
		<option type="text" value="<?php echo $dept_array->id; ?>" ><?php echo $dept_array->name; ?></option>
<?php
	}
?>