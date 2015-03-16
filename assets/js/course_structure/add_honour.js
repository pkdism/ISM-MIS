/*
* Add.js -  javascript file used in add.php
*/
$(document).ready(function(){

	$box_form = $("#box_form");
	$add_course_form = $("#add_course_form");
	//$form_table = $("#form_table");
	$dept_selection = $('#dept_selection');
	$course_selection = $('#course_selection');
	$branch_selection = $('#branch_selection');
	$semester_selection = $("#semester");
	$session_selection = $("#session_selection");
	
	$cont_course_selection = $('#cont_course_selection');
	$cont_branch_selection = $('#cont_branch_selection');
	$cont_semester_selection = $("#cont_semester");
	$cont_session_selection = $("#cont_session_selection");
	
	
	$course_selection.hide();
	$branch_selection.hide();
	$semester_selection.hide();
	$session_selection.hide();
	
	$cont_course_selection.hide();
	$cont_branch_selection.hide();
	$cont_semester_selection.hide();
	$cont_session_selection.hide();
	

	$duration = 1;
	
	function add_course(){
		$box_form.showLoading();
		$.ajax({url:site_url("course_structure/add/json_get_course/"+$dept_selection.find(':selected').val()),
			success:function(data){
				var base_str = "<option value = '' selected='selected' disabled>Select Course</option>";
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
			$box_form.hideLoading();
				console.log(error);
			}
		});
	}
	
	
	function add_branch(duration){
		$course_selection = $('#course_selection');
		$dept_selection = $('#dept_selection');
		
		//alert($course_selection.find(':selected').val());
		$box_form.showLoading();
		$.ajax({url:site_url("course_structure/add/json_get_branch/"+$course_selection.find(':selected').val()+"/"+$dept_selection.find(':selected').val()),
			success:function(data){
				console.log(data);
				base_str_branch = "<option value = '' selected = 'selected' disabled>Select Branch</option>";
				for($d=0 ; $d < data.length;$d++){
					base_str_branch += "<option value=\""+ data[$d]["id"]+"\">"+data[$d]["name"]+"</option>";
				}
				//base_str_branch += "<option>Select Branch</option>";
				
				$cont_branch_selection.show();
				$branch_selection.show().html(base_str_branch);
				
				var d = new Date();
				var n = d.getFullYear();
				base_str = "<option value = '' selected = 'selected' disabled>Valid From</option>";
				
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
			
			for(counter = 1; counter <= 2*duration ; counter++){
				base_str += "<option value=\""+counter+"\">"+counter+"</option>";
			}
		}
		else{
			for(counter = 3; counter <= 2*duration ; counter++){
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
		if($dept_selection.val() == "comm")
		{
			alert("To add for 1st Year please visit CourseStructure->add course structure->for 1st year Common");
		}
		else
			add_course();
		
	});

});