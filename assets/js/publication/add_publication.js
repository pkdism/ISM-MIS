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
function get_publication_type(type)
{
	var xmlhttp = getxmlhttp();
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status==200)
		{
			document.getElementById("pub_type").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST",site_url("publication/add_publication_ajax/get_type/"+type),true);
	xmlhttp.send();
	return false;
}
function get_authors(type)
{
	if(type !== ''){
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				document.getElementById("num_author").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("POST",site_url("publication/add_publication_ajax/add_authors/"+type),true);
		xmlhttp.send();
		return false;
	}
	else{
		document.getElementById("num_author").innerHTML = '';
	}
}
function add_template(type,type1)
{
	var xmlhttp = getxmlhttp();
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status==200)
		{
			document.getElementById("other_author"+type1).innerHTML = xmlhttp.responseText;

			var xmlhttp_ = getxmlhttp();
			xmlhttp_.onreadystatechange = function()
			{
				if (xmlhttp_.readyState == 4 && xmlhttp_.status==200)
				{
					document.getElementById("department_name"+type1).innerHTML = xmlhttp_.responseText;
				}
			}
			xmlhttp_.open("POST",site_url("publication/add_publication_ajax/find_department/"+type+"/"+type1),true);
			xmlhttp_.send();
			
		}
	}
	xmlhttp.open("POST",site_url("publication/add_publication_ajax/input_authors/"+type+"/"+type1),true);
	xmlhttp.send();
	return false;
}
function find_faculty(type,type1)
{
	var xmlhttp = getxmlhttp();
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status==200)
		{
			document.getElementById("author_"+type1+"_emp_id").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST",site_url("publication/add_publication_ajax/find_faculty/"+type),true);
	xmlhttp.send();
	return false;
}

function find_faculty_query(type)
{
	var xmlhttp = getxmlhttp();
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status==200)
		{
			document.getElementById("faculty_name").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST",site_url("publication/add_publication_ajax/find_faculty_for_query/"+type),true);
	xmlhttp.send();
	return false;
}

function get_dept(type)
{
	var xmlhttp = getxmlhttp();
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status==200)
		{
			document.getElementById("department_name").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST",site_url("publication/search_publication_ajax/find_department/"+type),true);
	xmlhttp.send();
	return false;
}

function get_dept_query(type)
{
	var xmlhttp = getxmlhttp();
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status==200)
		{
			document.getElementById("department_name").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST",site_url("publication/search_publication_ajax/find_department_query/"+type),true);
	xmlhttp.send();
	return false;
}