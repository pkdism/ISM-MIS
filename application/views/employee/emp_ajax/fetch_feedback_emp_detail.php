<?php
	if($feedback_emp_detail)
	{
		echo "({";
		foreach($feedback_emp_detail as $key => $val) {
			echo "'$key': '$val'";
			if($key != 'physically_challenged') echo ", ";
		}
		echo "})";
	}
	else
	{
		if(isset($error))	echo $error;
	}
?>