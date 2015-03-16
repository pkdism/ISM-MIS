<?php

	// Ajax giving grade_pay options for a particular pay_band

	if($grade_pays !== '')
	{
		if($grade_pays === FALSE)
			echo '<option value="" disabled="disabled">No pay band found</option>';
		else
			foreach($grade_pays as $row)
			{
				echo '<option value="'.$row->pay_code.'">'.$row->grade_pay.'</option>';
			}
	}
	else
		echo '<option disabled="disabled" selected value="">Select a Pay Band</option>';
?>

