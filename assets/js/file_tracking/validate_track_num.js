$(document).ready(function(){
	$('#Validate').click(function(){
		if ($('#track_num').val() == "")
		{
			alert("Please Enter Track Number.");
			return;
		}	
		if (isNaN($('#track_num').val()))
		{
			alert ("Please Enter digits only!!");
			return;
		}
		$.ajax({url : site_url("file_tracking/receive_file_ajax/send_details/"+$('#file_id').val()+"/"+$('#track_num').val()),
				success : function (result) {
					$('#send').html(result);
				}});
	});
});
