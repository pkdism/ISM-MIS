
<?php
	//print_r($result);	?>
	<option type="text" value="all" ><?php echo "All"; ?></option>
	<?php
	foreach($result as $faculty_array)
	{
?>
		<option type="text" value="<?php echo $faculty_array->id; ?>" ><?php echo $faculty_array->salutation." ".$faculty_array->name; ?></option>
<?php
	}
?>