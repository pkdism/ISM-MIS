<option type="text" value="">Select</option>		
<?php
	$sno=1;
	while ($sno <= $total_rows)
	{
?>
			<option type="text" value="<?php echo $data_array[$sno][1]; ?>" ><?php echo $data_array[$sno][2]; ?></option>
<?php
			$sno++;	
	}
?>
