<?php
//print_r($result);?>

	<option type="text" value="all" ><?php echo "All"; ?></option>
	<?php
	foreach($result as $dept_array)
	{
?>
		<option type="text" value="<?php echo $dept_array->id; ?>" ><?php echo $dept_array->name; ?></option>
<?php
	}
?>