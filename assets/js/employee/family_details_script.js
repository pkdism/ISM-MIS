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

$(document).ready(function() {
    $("#next_btn").click(function(e) {
                if(!confirm('Are you sure not to add more details and go to next step ?'))
                        e.preventDefault();
    });
    $("#add_btn").click(function(e) {
            if(!onclick_add())
                    e.preventDefault();
    });

    $('#status_toggle').click(function(){
    	change_act($('input[name=active3]'),$('#status_toggle'));
    });

    $("input[name=dob3]").datepicker("setEndDate", new Date());
});
