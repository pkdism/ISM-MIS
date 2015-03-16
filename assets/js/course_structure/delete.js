$(document).ready(function (){

$course_selection = $('#course_selection');
$branch_selection = $('#branch_selection');

$cont_course_selection = $('#cont_course_selection');
$cont_branch_selection = $('#cont_branch_selection');
$box_form = $("#box_outter");

	$("#btn_course").click(function (){
		if(confirm("Are you sure you want to delete course "+$course_selection.find(':selected').val()))
		{
			$box_form.showLoading();	
			$.ajax({
				url:site_url("course_structure/delete/json_delete_course/"+$course_selection.find(':selected').val()),
				success:function(data){
					getCourses();
					$box_form.hideLoading();
						
				},
				
				type:"POST",
				dataType:"json",
				fail:function(error){
					console.log(error);
					$box_form.hideLoading();
				}
			});
		}
	});
	$("#btn_branch").click(function (){
		if(confirm("Are you sure you want to delete branch "+$branch_selection.find(':selected').val()))			
		{
			$box_form.showLoading();
			$.ajax({
				url:site_url("course_structure/delete/json_delete_branch/"+$branch_selection.find(':selected').val()),
				success:function(data){
					getBranches()
					$box_form.hideLoading();	
				},
				
				type:"POST",
				dataType:"json",
				fail:function(error){
					console.log(error);
					$box_form.hideLoading();
				}
			});
		}
	});
	
	function getCourses()
	{
		$.ajax({
				url:site_url("course_structure/delete/json_get_course/"),
				success:function(data){
					var base_str = "<option value = '0' selected='selected' disabled>Select Course</option>";
					for($d=0 ; $d < data.length;$d++) {
						base_str += "<option  value='"+ data[$d]['id']+"'>"+data[$d]["name"]+"</option>";
					}
					$course_selection.html(base_str);
					alert("Course Deleted Successfully.");
					$box_form.hideLoading();	
				},
				
				type:"POST",
				dataType:"json",
				fail:function(error){
					console.log(error);
					$box_form.hideLoading();
				}
			});
	}
	
	function getBranches()
	{
		$.ajax({
				url:site_url("course_structure/delete/json_get_branch/"),
				success:function(data){
					var base_str = "<option value = '0' selected='selected' disabled>Select Branch</option>";
					for($d=0 ; $d < data.length;$d++) {
						base_str += "<option  value='"+ data[$d]['id']+"'>"+data[$d]["name"]+"</option>";
					}
					$branch_selection.html(base_str);
					$box_form.hideLoading();	
					alert("Branch Deleted Successfully.");
				},
				
				type:"POST",
				dataType:"json",
				fail:function(error){
					console.log(error);
					$box_form.hideLoading();
				}
			});
	}
});
/*
$(document).ready(function(){

	$add_course_form = $("#add_course_form");
	//$form_table = $("#form_table");
	$box_form = $("#box_form");
	$course_selection = $('#course_selection');
	$branch_selection = $('#branch_selection');
	
	$cont_course_selection = $('#cont_course_selection');
	$cont_branch_selection = $('#cont_branch_selection');
	
	
	//$course_selection.hide();
	//$branch_selection.hide();
	
	//$cont_course_selection.hide();
	//$cont_branch_selection.hide();
	
	function add_course(){
		$box_form.showLoading();
		$.ajax({
			url:site_url("course_structure/add/json_get_course/"+$dept_selection.find(':selected').val()),
			success:function(data){
				var base_str = "<option value = '0' selected='selected' disabled>Select Course</option>";
				for($d=0 ; $d < data.length;$d++) {
					base_str += "<option data-duration='"+data[$d]['duration']+"' value='"+ data[$d]['id']+"'>"+data[$d]["name"]+"</option>";
				}
				
				$cont_course_selection.show();
				$course_selection.show().html(base_str);
				$select_course = $('select#course_selection');
				$select_course.on('change',function(){
					$branch_selection.hide();
					$session_selection.hide();
					$semester_selection.hide();
					
					$cont_branch_selection.hide();
					$cont_session_selection.hide();
					$cont_semester_selection.hide();
					
					add_branch(parseInt($('#course_selection option:selected').data('duration')));
					
				});
				$box_form.hideLoading();
			},
			type:"POST",
			//data :JSON.stringify({course:$course_selection.find(':selected').val()}),
			dataType:"json",
			fail:function(error){
				console.log(error);
				$box_form.hideLoading();
			}
		});
	}
	
	
	function add_branch(duration){
		$course_selection = $('#course_selection');
		$dept_selection = $('#dept_selection');
		$box_form.showLoading();
		//alert($course_selection.find(':selected').val());
		$.ajax({url:site_url("course_structure/add/json_get_branch/"+$course_selection.find(':selected').val()+"/"+$dept_selection.find(':selected').val()),
			success:function(data){
				
				base_str_branch = "<option selected = 'selected' disabled>Select Branch</option>";
				for($d=0 ; $d < data.length;$d++){
					base_str_branch += "<option value=\""+ data[$d]["id"]+"\">"+data[$d]["name"]+"</option>";
				}
				//base_str_branch += "<option>Select Branch</option>";
				
				$cont_branch_selection.show();
				$branch_selection.show().html(base_str_branch);
				
				var d = new Date();
				var n = d.getFullYear();
				base_str = "<option selected = 'selected' disabled>Valid From</option>";
				
				for($d=n-5;$d<=n+5;$d++)
				{
					var session = $d+"_"+($d+1);
					base_str += "<option value= '"+session+"'>"+$d+"-"+($d+1)+"</option>"
				}	
				
				$cont_session_selection.show();
				$session_selection.show().html(base_str);
				$branch_selection.on('change',function(){
					//$session_selection.hide();
					$semester_selection.hide();
					$cont_semester_selection.hide();
					add_semester(duration);
				});
				$box_form.hideLoading();
				
			},
			type:"POST",
			//data :JSON.stringify({course:$course_selection.find(':selected').val()}),
			dataType:"json",
			fail:function(error){
				console.log(error);
				$box_form.hideLoading();
			}
		});
	}
	
	function add_semester(duration){
		
		base_str = "";
		if($course_selection.find(':selected').val() == 'ug_comm')
		{
			for(counter = 1; counter <= 2 ; counter++){
				if(counter == 1)
					base_str += "<option value=\""+counter+"\">"+"Physics(Group "+counter+")"+"</option>";
				else if(counter == 2)
					base_str += "<option value=\""+counter+"\">"+"Chemistry(Group "+counter+")"+"</option>";
			}
			
		}
		else if(duration < 4){
			base_str = "<option value = '0'>All</option>";
			for(counter = 1; counter <= 2*duration ; counter++){
				base_str += "<option value=\""+counter+"\">"+counter+"</option>";
			}
		}
		else{
			base_str = "<option value = '0'>All</option>";
			for(counter = 1; counter <= 2*duration ; counter++){
				base_str += "<option value=\""+counter+"\">"+counter+"</option>";
			}
			
		}
		
		$cont_semester_selection.show();
		$semester_selection.show().html(base_str);
	}

	$dept_selection.change(function(){
		$("#branch_selection").hide();
		$("#session_selection").hide();
		$("#semester").hide();
		$("#cont_branch_selection").hide();
		$("#cont_session_selection").hide();
		$("#cont_semester").hide();
		
		add_course();
	});

});*/