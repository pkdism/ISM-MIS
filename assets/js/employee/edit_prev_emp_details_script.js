function onclick_add() {
        var d=document.getElementsByName("designation2")[0].value;
        var f=document.getElementsByName("from2")[0].value;
        var t=document.getElementsByName("to2")[0].value;
        var a=document.getElementsByName("addr2")[0].value;
        var r=document.getElementsByName("payscale2")[0].value;

        if(d=="" || f=="" || t=="" || a=="" || r=="")
        {
                alert('Please fill up all the fields !!');
                return false;
        }
        else if(moment(f,"DD-MM-YYYY").isAfter(moment(t,'DD-MM-YYYY')))
        {
                alert('Fill the period correctly !!');
                return false;
        }
        else
                return true;
}

function onclick_delete(i) {
	var result=confirm("Do you really want to delete ?");
	if(result==true) {
		var table=document.getElementById('tbl2');
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

			    $('#show_details').fadeOut('slow',function(){
			    	$(this).removeClass('box-success').removeClass('box-danger').addClass('box-warning').fadeIn('fast');
			    	$('#show_details').find('.box-title').html("Previous Employment Details <label class=\"label label-warning\">Pending for Approval</label>");
			    });
			    table.innerHTML=xmlhttp.responseText;
			    $('#show_details').hideLoading();
		    }
	  	}
	  	xmlhttp.open("POST",site_url("employee/emp_ajax/delete_record/2/"+i),true);
	  	$('#show_details').showLoading();
		xmlhttp.send();
	}
}

function closeframe() {
	$('#edit_div').remove();
}

function onclick_edit(i, from, to, date)
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
			$("#edit_from"+i).datepicker("setEndDate", moment($("#edit_from"+i).attr('max'), "DD-MM-YYYY").toDate());
			$("#edit_to"+i).datepicker("setEndDate", moment($("#edit_to"+i).attr('max'), "DD-MM-YYYY").toDate());
			$("#edit_from"+i).datepicker("setDate", moment($("#edit_from"+i).attr('value'), "DD-MM-YYYY").toDate());
			$("#edit_to"+i).datepicker("setDate", moment($("#edit_to"+i).attr('value'), "DD-MM-YYYY").toDate());
	    }
  	}
  	xmlhttp.open("POST",site_url("employee/emp_ajax/edit_record/2/"+i),true);
	xmlhttp.send();
}

function onclick_save(i) {
	var a=document.getElementById("edit_addr"+i).value;
	var d=document.getElementById("edit_designation"+i).value;
	var f=document.getElementById("edit_from"+i).value;
	var t=document.getElementById("edit_to"+i).value;
	var p=document.getElementById("edit_payscale"+i).value;

	if(a=="" || d=="" || f=="" || t=="" || p=="")
		alert("!! Please fill up all the fields !!");
	else if(moment(f,"DD-MM-YYYY").isAfter(moment(t,'DD-MM-YYYY')))
		alert("!! Fill the period correctly !!");
	else
		return true;
	return false;
}

$(document).ready(function() {
        $("#add_btn").click(function(e) {
                if(!onclick_add())
                        e.preventDefault();
        });

		$("input[name=from2]").datepicker("setEndDate", moment($("input[name=from2]").attr('max'), "DD-MM-YYYY").toDate());
		$("input[name=to2]").datepicker("setEndDate", moment($("input[name=to2]").attr('max'), "DD-MM-YYYY").toDate());

        $("#back_btn").click(function(e) {
                window.location.href = site_url("employee/edit");
        });
});