	function onclick_emp_id()
	{
		document.getElementById('search_eid').style.display="inherit";
		//changes
		var dept=document.getElementById('emp_dept');		
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
			    dept.innerHTML += xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",site_url("super_admin/admin_ajax/get_dept"),true);
		xmlhttp.send();
	}

	function onclick_empname()
	{
		document.getElementById('employee').style.display="inherit";
		var emp_name=document.getElementById('employee_select');
		var dept=document.getElementById('emp_dept').value;
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
			    emp_name.innerHTML += xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",site_url("ajax/empNameByDept/"+dept),true);
		xmlhttp.send();
		emp_name.innerHTML = "<i class=\"loading\"></i>";
	}

	function onclick_emp_nameid()
	{
		var emp_name_id=document.getElementById('employee_select').value;
		document.getElementById('emp_id').value=emp_name_id;
	}

	function onchange_auth()
	{
		var auth_id=document.getElementById('auth_id').value;
		var dept_id=document.getElementById('dept_id').value;
		var view_users=document.getElementById('view_users');
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
			    view_users.innerHTML = xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",site_url("super_admin/admin_ajax/getUsersByDeptAuth/"+dept_id+"/"+auth_id),true);
		xmlhttp.send();
		view_users.innerHTML = "<center><i class=\"loading\"></i></center>";
	}

	function delete_auth(id)
	{
		var result=confirm("Do you really want to deny the authorization ?");
		if(result==true)
		{
			var auth_id=document.getElementById('auth_id').value;
			var dept_id=document.getElementById('dept_id').value;
			var view_users=document.getElementById('view_users');
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
				    view_users.innerHTML = xmlhttp.responseText;
			    }
		  	}
			xmlhttp.open("POST",site_url("super_admin/admin_ajax/deleteAuth/"+id+"/"+dept_id+"/"+auth_id),true);
			xmlhttp.send();
			view_users.innerHTML = "<center><i class=\"loading\"></i></center>";
		}
	}
	
		function onload_emp_id()
	{
		var dept=document.getElementById('emp_id');		
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
			    dept.innerHTML += xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",site_url("super_admin/admin_ajax/get_emp_id"),true);
		xmlhttp.send();
	}

	function onload_auth(id)
	{
		var dept=document.getElementById(''+id+'');
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
			    dept.innerHTML += xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",site_url("super_admin/admin_ajax/get_auths"),true);
		xmlhttp.send();
	}

	function onload_dept()
	{
		var dept=document.getElementById('dept_id');
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
			    dept.innerHTML += xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",site_url("super_admin/admin_ajax/get_dept"),true);
		xmlhttp.send();
	}
