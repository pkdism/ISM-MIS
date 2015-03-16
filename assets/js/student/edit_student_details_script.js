$(document).ready(function() {
	$('#form_submit').on('submit', function(e) {
		if(!form_validation())
			e.preventDefault();
	});
});

function form_validation()
{
	var stu_id = document.getElementsByName("stu_id")[0].value;
	//alert(stu_id);
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
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {

	    }
  	}
  	
  	xmlhttp.open("POST",site_url("student/student_ajax/check_if_user_exists/"+stu_id),false);
	xmlhttp.send();
	if(xmlhttp.responseText == '')
	{
	 	alert('User does not exist.');
	 	return false;
	}
	else
	{
		return true;
	}
}