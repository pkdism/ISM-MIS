function onclick_add()
{
	var n=document.getElementsByName("name3")[0].value;
	var r=document.getElementsByName("relationship3")[0].value;
	var p=document.getElementsByName("profession3")[0].value;
	var a=document.getElementsByName("addr3")[0].value;
	var d=document.getElementsByName("dob3")[0].value;
	var file=document.getElementsByName("photo3")[0].files[0];
	if(file)
		var f=file.name;
	else
		var f="";

	if(n=="" || r=="" || p=="" || a==""	||	f=="" || d=="")
		alert('!! Please fill up all the fields !!');
	else
	{
		var ext=f.substring(f.lastIndexOf('.') + 1);
		if(ext == "bmp" || ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg" )
		{
			if(file.size>204800)
				alert('The file size must be less than 200KB');
			else
				return true;
		}
		else
			alert('The image should be in bmp, gif, png, jpg or jpeg format.');
	}
	return false;
}


function change_act(obj,btn)
{
	if(obj.val()=="Active")
	{
		btn.css('background',"#f56954");
		obj.val("Inactive");
		btn.find('i').attr('class','fa fa-times');
	}
	else
	{
		btn.css('background',"#00a65a");
		obj.val("Active");
		btn.find('i').attr('class','fa fa-check');
	}
}

function closeframe()
{
	$('#edit_div').remove();
}

function onclick_edit(i, dob, photopath)
{
	var xmlhttp;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}
	else {
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
		    var coverdiv = '<div id="coverdiv" style="height: 100%; width: 100%; top: 0px; left: 0px; opacity: 0.5; position: fixed; z-index: 2000; background: rgb(170, 170, 170);"></div>';
			var formdiv = '<div id="formdiv" style="height: auto; width: auto; top: 10%; left: 15%; right:15%; display: block; position: absolute; z-index: 2001; background: #FEFEFE;">';
			formdiv+=xmlhttp.responseText+'</div>';
			var div = document.createElement('div');
			div.setAttribute("id", "edit_div");
			div.innerHTML=coverdiv+formdiv;
			document.body.appendChild(div);
			$("#edit_photo_container"+i+" img").attr("src", base_url()+'assets/images/'+photopath);
			$("#edit_status_toggle").click(function(){
				change_act($('#edit_active'+i),$('#edit_status_toggle'));
			});
			//date picker hack
			$("#edit_dob"+i).datepicker({
						format: "dd-mm-yyyy",
						autoclose: true,
						todayBtn: "linked"
			});
			$("#edit_dob"+i).datepicker("setDate", moment($("#edit_dob"+i).attr('value'), "DD-MM-YYYY").toDate());
			//image picker hack  (// as it not works normally in modals)
			$("#edit_photo"+i).on("change", function(event) {
					var input = event.target;
					var reader = new FileReader();
					reader.onload = function(){
						var dataURL = reader.result;
						$("#edit_photo"+i).parent().find("img").attr("src", dataURL);
						// output.src = dataURL;
					};
					reader.readAsDataURL(input.files[0]);
			});
			$("#edit_photo"+i).next().addClass("no-padding");
	    }
  	}
  	xmlhttp.open("POST",site_url("employee/emp_ajax/edit_record/3/"+i),true);
	xmlhttp.send();
}

function onclick_save(i)
{
	var p=document.getElementById("edit_profession"+i).value;
	var a=document.getElementById("edit_address"+i).value;
	var d=document.getElementById("edit_dob"+i).value;
	var act=document.getElementById("edit_active"+i).value;

	if(p=="" || a=="" || d=="")
	{
		alert("!! Please fill up the fields !!");
	}
	else
	{
		return true;
	}
	return false;
}

$(document).ready(function() {
    $("#add_btn").click(function(e) {
            if(!onclick_add())
                    e.preventDefault();
    });

    $('#status_toggle').click(function(){
    	change_act($('input[name=active3]'),$('#status_toggle'));
    });

    $("input[name=dob3]").datepicker("setEndDate", new Date());

    $("#back_btn").click(function(e) {
                window.location.href = site_url("employee/edit");
        });
});
