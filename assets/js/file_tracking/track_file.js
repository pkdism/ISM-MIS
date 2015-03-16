$(document).ready(function(){

	$('#submit').click(function(){

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
//		var $mybox = $('#move_details_by_track_num');
//		$mybox.showLoading();

		$.ajax({url : site_url("file_tracking/track_file/validate_track_num/"+$('#track_num').val()),
				success : function (result) {
					$('#move_details_by_track_num').html(result);
				}});
//		$mybox.hideLoading();
	});
});