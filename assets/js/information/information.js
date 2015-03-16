function suggest(text)
	{	
		//alert(link);
		var xmlhttp = getxmlhttp();
		if(text==""){
			return false;
		}
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//document.getElementById("content").hide();
				document.getElementById("content").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST", site_url("information/view_notice/search/archived/"+text),true);
		xmlhttp.send();
		return false;
	}