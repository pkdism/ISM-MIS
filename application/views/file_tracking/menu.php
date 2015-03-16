<?php
//	echo "<h2><a href = \"".site_url('employee/add')."\" >Add Employee</a></h2>";
//	if($entry)
//		echo "(Continue with Employee ".$entry->id.")";
?>
<br>
<h2><a href = "<?php echo site_url('file_tracking/send_new_file'); ?>" >Send New File</a></h2>
<h2><a href = "<?php echo site_url('file_tracking/receive_file'); ?>" >Receive File</a></h2>
<h2><a href = "<?php echo site_url('file_tracking/send_running_file'); ?>" >Send Running File</a></h2>
<h2><a href = "<?php echo site_url('file_tracking/close_file'); ?>" >Close File</a></h2>
<h2><a href = "<?php echo site_url('file_tracking/track_file'); ?>" >Track File</a></h2>

<?php

	// $password = 'p';
	// $password = $this->authorization->strclean($password);
	// echo $password.'<br>';
	// echo $this->authorization->encode_password($password,'2014-12-22 14:30:18');
	// print_r($this->session->all_userdata());

?>