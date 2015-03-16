<?php
	echo "<h2><a href = \"".site_url('employee/add')."\" >Add Employee</a></h2>";
	if($entry)
		echo "(Continue with Employee ".$entry->id.")";
?>
<br>
<h2><a href = "<?php echo site_url('employee/edit'); ?>" >Edit Employee Details</a></h2>
<br>
<h2><a href = "<?php echo site_url('employee/view'); ?>" >View Employee Details</a></h2>
<br>
<h2><a href = "<?php echo site_url('employee/validation'); ?>" >Employee Validation Requests</a></h2>

<?php
	//var_dump($user);
	// $password = 'p';
	// $password = $this->authorization->strclean($password);
	// echo $password.'<br>';
	// echo $this->authorization->encode_password($password,'2014-12-22 14:30:18');
	// print_r($this->session->all_userdata());
?>