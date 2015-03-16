$(document).ready(function(){
	$('#close').click(function(){
		window.location.href=site_url('file_tracking/close_file/insert_close_details/'+(<?php echo $file_id; ?>));
	});	
});