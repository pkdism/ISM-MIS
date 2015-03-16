$(document).ready(function(){
	$("#photo").change(function(){
						readURL(this);
						});
});
$('.-mis-content').delegate(".flash-data.error-msg a.close-btn", 'click', function(e) {
		e.preventDefault();
		$(this).parent().remove();
	});
function showError(errorMessage, errorTarget) {
	
	var errorElement = $('<div class="flash-data error-msg"><a class="close-btn" href="#" style="position: absolute; right: 20px; z-index: 1000;">x</a><p style="opacity: ; top: 0px;" class="notification error">'+errorMessage+'</p></div>');
	$(errorTarget).prepend(errorElement);
	$(errorElement).css({
		"opacity": "0",
		"margin-top": "-20px"
	}).animate({
		opacity: "1",
		"margin-top": "0px"
	}, 500);
}
function readURL(input) {
	var allowedTypes = {
		"image/jpeg": true,
		"image/bmp": true,
		"image/jpg": true,
		"image/png": true,
		"image/gif": true
	};
        if (input.files && input.files[0]) {
			var file = input.files[0];
			var error = false;
			if(!allowedTypes[file.type]) {
				alert("Invalid filetype, Choose again!");
				error = true;
			}
			else if(file.size > 1024*1024) {
				alert('Image Size is greator than 1 MB, Choose again!');
				//showError('Size is greater than 1MB.', errorTarget);
				error = true;
			}
			if(error) {
				input.value = null;
				$("#preview").attr("style", "");
			}
            /*var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').css({
						height: "60px", 
						width: "60px",
						"background-image": "url('"+e.target.result+"')",
						"background-size": "auto 100%",
						"background-position": "50% 50%",
						"background-repeat": "no-repeat"
					});
            };

            reader.readAsDataURL(input.files[0]);*/
        }
}
