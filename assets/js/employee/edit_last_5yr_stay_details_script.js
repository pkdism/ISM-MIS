function onclick_add()
{
    var f=document.getElementsByName("from5")[0].value;
    var t=document.getElementsByName("to5")[0].value;
    var a=document.getElementsByName("addr5")[0].value;
    var d=document.getElementsByName("dist5")[0].value;

    if(f=="" || t=="" || a=="" || d=="" )
            alert('Please fill up all the fields !!');
    else if(moment(f,"DD-MM-YYYY").isAfter(moment(t,'DD-MM-YYYY')))
            alert('Error : Fill the period of entering and leaving correctly !!');
    else
        return true;
    return false;
}

function onclick_delete(i)
{
	var result=confirm("Do you really want to delete ?");
	if(result==true)
	{
		var table=document.getElementById('tbl5');
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
		    	$('#show_details').fadeOut('slow',function(){
			    	$(this).removeClass('box-success').removeClass('box-danger').addClass('box-warning').fadeIn('fast');
			    	$('#show_details').find('.box-title').html("Last 5 Year Stay Details <label class=\"label label-warning\">Pending for Approval</label>");
			    });
			    table.innerHTML=xmlhttp.responseText;
			    $('#show_details').hideLoading();
		    }
	  	}
	  	xmlhttp.open("POST",site_url("employee/emp_ajax/delete_record/5/"+i),true);
	  	$('#show_details').showLoading();
		xmlhttp.send();
	}
}

function onclick_edit(i)
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
			//date picker hack
			$("#edit_from"+i).datepicker({
						format: "dd-mm-yyyy",
						autoclose: true,
						todayBtn: "linked"
			});
			$("#edit_to"+i).datepicker({
						format: "dd-mm-yyyy",
						autoclose: true,
						todayBtn: "linked"
			});
			$("input[name=edit_from"+i+"]").datepicker("setStartDate", moment($("input[name=edit_from"+i+"]").attr('min'), "DD-MM-YYYY").toDate());
	        $("input[name=edit_from"+i+"]").datepicker("setEndDate", moment($("input[name=edit_from"+i+"]").attr('max'), "DD-MM-YYYY").toDate());
	        $("input[name=edit_to"+i+"]").datepicker("setStartDate", moment($("input[name=edit_to"+i+"]").attr('min'), "DD-MM-YYYY").toDate());
	        $("input[name=edit_to"+i+"]").datepicker("setEndDate", moment($("input[name=edit_to"+i+"]").attr('max'), "DD-MM-YYYY").toDate());
	        $("input[name=edit_from"+i+"]").datepicker("setDate", moment($("input[name=edit_from"+i+"]").attr('value'), "DD-MM-YYYY").toDate());
	        $("input[name=edit_to"+i+"]").datepicker("setDate", moment($("input[name=edit_to"+i+"]").attr('value'), "DD-MM-YYYY").toDate());
	    }
  	}
  	xmlhttp.open("POST",site_url("employee/emp_ajax/edit_record/5/"+i),true);
	xmlhttp.send();
}

function onclick_save(i)
{
	var f=document.getElementById("edit_from"+i).value;
	var t=document.getElementById("edit_to"+i).value;
	var a=document.getElementById("edit_addr"+i).value;
	var d=document.getElementById("edit_dist"+i).value;

	if(f=="" || t=="" || a=="" || d=="" )
		alert("!! Please fill up all the fields !!");
	else if(moment(f,"DD-MM-YYYY").isAfter(moment(t,'DD-MM-YYYY')))
		alert("!! Error : Fill the period of entering and leaving correctly !!");
	else
	{
		return true;
	}
	return false;
}

function closeframe()
{
	$('#edit_div').remove();
}

$(document).ready(function() {
    $("#add_btn").click(function(e) {
            if(!onclick_add())
                    e.preventDefault();
    });

    $("input[name=from5]").datepicker("setStartDate", moment($("input[name=from5]").attr('min'), "DD-MM-YYYY").toDate());
    $("input[name=from5]").datepicker("setEndDate", moment($("input[name=from5]").attr('max'), "DD-MM-YYYY").toDate());
    $("input[name=to5]").datepicker("setStartDate", moment($("input[name=to5]").attr('min'), "DD-MM-YYYY").toDate());
    $("input[name=to5]").datepicker("setEndDate", moment($("input[name=to5]").attr('max'), "DD-MM-YYYY").toDate());

    $("#back_btn").click(function(e) {
            window.location.href = site_url("employee/edit");
    });
});