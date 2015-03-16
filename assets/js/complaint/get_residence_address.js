$(document).ready(function(){
	$("#location").on('change', function() {
		if ($("#location").val() == "Residence") {
			$.ajax({url : site_url("complaint/get_residence_address_ajax"),
					success : function (result) {
						$('#locationDetails').val(result);
					}});
		}
	});
});