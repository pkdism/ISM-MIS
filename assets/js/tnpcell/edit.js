function EditProject(seq,id)
{
	
    if($("#editbutton_project"+seq).val() == "Edit")
    {
      $("[name='place"+seq+"']").prop('disabled',false);
      $("[name='title"+seq+"']").prop('disabled',false);
      $("[name='duration"+seq+"']").prop('disabled',false);
      $("[name='role"+seq+"']").prop('disabled',false);
      $("[name='description"+seq+"']").prop('disabled',false);
      $("#editbutton_project"+seq).val("Save");	
    }
    else if($("#editbutton_project"+seq).val() == "Save")
    {	
      var place= $("[name='place"+seq+"']").prop('disabled',true);
      var title= $("[name='title"+seq+"']").prop('disabled',true);
      var duration= $("[name='duration"+seq+"']").prop('disabled',true);
      var role= $("[name='role"+seq+"']").prop('disabled',true);
      var description= $("[name='description"+seq+"']").prop('disabled',true);
	  
	  var $project_details = {'id':id,'place':$("[name='place"+seq+"']").val(),'title':$("[name='title"+seq+"']").val(),'role':$("[name='role"+seq+       "']").val(),'description':$("[name='description"+seq+"']").val(),'duration':$("[name='duration"+seq+"']").val()};
	 // $project_details = JSON.stringify($project_details);
	  $project_details = JSON.stringify($project_details);
	 		
	  $.ajax({
		 url:site_url("tnpcell/cv/update_project"),
		 success:function (data){
		 	console.log(data);
		 },
		 type:"POST",
		 data:$project_details,
		 fail:function(error){
				//$box_form.hideLoading();
				console.log(error);
			}
		 
	  });
      $("#editbutton_project"+seq).val("Edit");
    }
}
function EditAchievements(seq)
{
	if($("#editbutton_achievements"+seq).val() == "Edit")
    {
      $("[name='category"+seq+"']").prop('disabled',false);
      $("[name='info"+seq+"']").prop('disabled',false);
      $("#editbutton_achievements"+seq).val("Save");	
    }
}