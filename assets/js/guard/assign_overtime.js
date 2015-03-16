$(document).ready(function(){
	$('#get_guards').click(function(){
		showGuards();
	});
	$('#minutes_to').change(function(){
		$('#get_guards').show();
	});
	$('#minutes_from').change(function(){
		$('#get_guards').show();
	});
	$('#hours_to').change(function(){
		$('#get_guards').show();
	});
	$('#hours_from').change(function(){
		$('#get_guards').show();
	});
});

function showGuards()
{
	var post_id= document.getElementById('post_id').value;
	var date= document.getElementById('date').value;
	var hours_from= document.getElementById('hours_from').value;
	var minutes_from= document.getElementById('minutes_from').value;
	var hours_to= document.getElementById('hours_to').value;
	var minutes_to= document.getElementById('minutes_to').value;
	var from_time = parseFloat(hours_from) + parseFloat(minutes_from);
	var to_time = parseFloat(hours_to) + parseFloat(minutes_to);
	var range = from_time + to_time;
	
	if(post_id == "")
	{
		alert("Fill post name");
		$("#post_id").focus();
	}
	else if(hours_from == "")
	{	
		alert("Fill from hours");
		$("#hours_from").focus();
	}
	else if(minutes_from == "")
	{	
		alert("Fill from minutes");
		$("#minutes_from").focus();
	}
	else if(hours_to == "")
	{	
		alert("Fill to hours");
		$("#hours_to").focus();
	}
	else if(minutes_to == "")
	{	
		alert("Fill to minutes");
		$("#hours_to").focus();
	}
	else if(!(from_time >=21.0 && to_time <= 8.0) && from_time > to_time)
	{
		alert("Time Range Invalid");
		document.getElementById('hours_from').value="";
		document.getElementById('hours_to').value="";
		document.getElementById('minutes_from').value="";
		document.getElementById('minutes_to').value="";
		$("#hour_from").focus();
	}
	else if(to_time - from_time >= 8.0 )
	{
		alert("Sorry, you are not allowed to assign duty for more than 8 hours.");
		document.getElementById('hours_from').value="";
		document.getElementById('hours_to').value="";
		document.getElementById('minutes_from').value="";
		document.getElementById('minutes_to').value="";
		$("#hour_from").focus();
	}
	else 
	{
		//alert(post_id + " " + date + " " + range);
		var xmlhttp;
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		  
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("guard-div").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("POST",site_url("guard/get_guards/index/" + post_id + "/" + date + "/" + from_time + "/" + to_time + "/" + range),true);
		xmlhttp.send();
		$("#get_guards").hide();
		return false;
	}
}	
