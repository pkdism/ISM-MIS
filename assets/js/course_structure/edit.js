//$box_form = $("#box_form");

$(document).ready(function() {
	$(".savebutton").hide();
});

function EditSubject(semester,seq_no)
{
	$("[name='subjectid_"+semester+"_"+seq_no+"']").prop('disabled',false);
	$("[name='subjectname_"+semester+"_"+seq_no+"']").prop('disabled',false);
	$("[name='subjectL_"+semester+"_"+seq_no+"']").prop('disabled',false);
	$("[name='subjectT_"+semester+"_"+seq_no+"']").prop('disabled',false);
	$("[name='subjectP_"+semester+"_"+seq_no+"']").prop('disabled',false);
	$("[name='subjectcredithours_"+semester+"_"+seq_no+"']").prop('disabled',false);
	$("[name='subjectcontacthours_"+semester+"_"+seq_no+"']").prop('disabled',false);
	$("[name='type_"+semester+"_"+seq_no+"']").prop('disabled',false);
	//alert($("#editbutton_"+semester+"_"+seq_no).val());
	$("#editbutton_"+semester+"_"+seq_no).hide();	
	$("#savebutton_"+semester+"_"+seq_no).show();	
}

function SaveSubject(semester,seq_no)
{
	$subjectid = $("[name='subjectid_"+semester+"_"+seq_no+"']");
	$subjectname = $("[name='subjectname_"+semester+"_"+seq_no+"']");
	$subjectL = $("[name='subjectL_"+semester+"_"+seq_no+"']");
	$subjectT = $("[name='subjectT_"+semester+"_"+seq_no+"']");
	$subjectP = $("[name='subjectP_"+semester+"_"+seq_no+"']");
	$subjectcredithours = $("[name='subjectcredithours_"+semester+"_"+seq_no+"']");
	$subjectcontacthours = $("[name='subjectcontacthours_"+semester+"_"+seq_no+"']");
	//console.log(semester+seq_no);
	$type = $("[name='type_"+semester+"_"+seq_no+"']");
	//$contacthours = $subjectL.val() + $subjectT.val() + $subjectP.val();
	
	$subjectid.prop("disabled",true);
	$subjectname.prop("disabled",true);
	$subjectL.prop("disabled",true);
	$subjectT.prop("disabled",true);
	$subjectP.prop("disabled",true);
	$subjectcredithours.prop("disabled",true);
	$subjectcontacthours.prop("disabled",true);
	$type.prop("disabled",true);
	
	var $subjectdetails = {'id':$subjectid.attr('id'),'subject_id':$subjectid.val(),'name':$subjectname.val(),'L':$subjectL.val(),'T':$subjectT.val(),'P':$subjectP.val(),'credit_hours':$subjectcredithours.val(),'contact_hours':$subjectcontacthours.val(),'type':$type.val()};
	$subjectdetails = JSON.stringify($subjectdetails);

	
	$box_form = $("#box_form_"+semester);	
	$box_form.showLoading();
	
	$.ajax({url:site_url("course_structure/edit/Json_UpdateCourseStructure/"),
		success:function(data){
			$box_form.hideLoading();
			$("#editbutton_"+semester+"_"+seq_no).show();	
			$("#savebutton_"+semester+"_"+seq_no).hide();	
		},
		type:"POST",
		data:$subjectdetails,
		fail:function(error){
			$box_form.hideLoading();
			console.log(error);
		}
	});
}


function DeleteSemester(semester,aggr_id)
{	
	$box_form = $("#box_form_"+semester);
	if(confirm("Delete Course Structure for Semester "+semester))
	{
		$box_form.showLoading();
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
				$box_form.hideLoading();
				alert("Deleted Successfully");
				document.location.href = site_url("course_structure/edit");
			}
		}	
		xmlhttp.open("GET",site_url("course_structure/edit/DeleteCourseStructure/"+semester+"/"+aggr_id),true);
		xmlhttp.send()	
	}
}