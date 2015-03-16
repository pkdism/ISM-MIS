function reject_reason(i)
{
	alert("Reason behind Rejection : \""+document.getElementById('rejected'+i).innerHTML+"\"");
}

function validation(step) {
	document.getElementById('reason_cover'+step).style.display='block';
	document.getElementById('b_reject'+step).style.display='none';
	document.getElementById('approve'+step).style.display='none';
	document.getElementById('reason'+step).required=true;
}
$(document).ready(function() {

	$('.pending').css("color", "#3A87AD");
	$('.rejected').css("color", "#d9534f");

	$("#back_btn").click(function(e){
		window.location.href = site_url("employee/validation");
	});

	$("#b_reject0").click(function(){
		validation(0);
	});
	$("#b_reject1").click(function(){
		validation(1);
	});
	$("#b_reject2").click(function(){
		validation(2);
	});
	$("#b_reject3").click(function(){
		validation(3);
	});
	$("#b_reject4").click(function(){
		validation(4);
	});
	$("#b_reject5").click(function(){
		validation(5);
	});
});