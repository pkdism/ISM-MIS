
<?php
	//print_r($result);	?>
	<?php
	foreach($result as $faculty_array)
	{
?>
		<option type="text" value="<?php echo $faculty_array->id; ?>" ><?php echo $faculty_array->salutation." ".$faculty_array->name; ?></option>
<?php
	}
?>