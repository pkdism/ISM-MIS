$(document).ready(function() {
	$("#UsersToValidateBox").showLoading();
	$.ajax({
		url: site_url("student/student_validate/loadUsersToValidate")
	}).done(function(userData) {
		(function() {
			var users = eval(userData);
			var $UsersToValidateTable = $("#UsersToValidate").dataTable();
			var data = [];
			for(var i = 0; i < users.length; i++) {
				data[i] = [
					users[i].id,
					users[i].details
				];
			}

			$UsersToValidateTable.fnAddData(data);
		})();
	}).always(function() {
		// Hide the loading gif, when request is complete.
		$("#UsersToValidateBox").hideLoading();
	});

	$('#form_submit').on('submit', function(e) {
		if(!form_validation())
			e.preventDefault();
	});

});

function form_validation()
{
	var stu_id = document.getElementsByName("stu_id")[0].value;
	if(stu_id.trim() == '')
	{
		alert('Please fill valid details in the field');
		return false;
	}
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	}
	xmlhttp.open("POST",site_url("student/student_ajax/check_if_user_for_validation_exists/"+stu_id),false);
	xmlhttp.send();

	if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			if(xmlhttp.responseText != '')
			{
			 	return true;
			}
			else
			{
				alert('No such users details for Validation.');
				return false
			}
		}
}