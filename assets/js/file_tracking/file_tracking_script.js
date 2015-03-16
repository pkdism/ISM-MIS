	function getxmlhttp()
	{
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	    }
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		return xmlhttp;
	}
	function get_file_move_details_of_sent_files(track_num)
	{
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				document.getElementById("move_details_of_sent_files").innerHTML = xmlhttp.responseText;
				$(window).scrollTop($('#move_details_of_sent_files').offset().top);
			}
		}
		xmlhttp.open("POST",site_url("file_tracking/track_file/validate_track_num/"+track_num),true);
		xmlhttp.send();
		return false;
	}	