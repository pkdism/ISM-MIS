
$(document).ready(function(){

	$add_course_form = $("#add_course_form");
	//$form_table = $("#form_table");
	$box_form = $("#box_form");
	$dept_selection = $('#dept_selection');
	$course_selection = $('#course_selection');
	$branch_selection = $('#branch_selection');
	$semester_selection = $("#semester");
	$session_selection = $("#session_selection");
	$group_selection = $("#group_selection");
	
	$cont_course_selection = $('#cont_course_selection');
	$cont_branch_selection = $('#cont_branch_selection');
	$cont_semester_selection = $("#cont_semester");
	$cont_session_selection = $("#cont_session_selection");
	$cont_group_selection = $("#cont_group");
	
	
	$course_selection.hide();
	$branch_selection.hide();
	$semester_selection.hide();
	$session_selection.hide();
	$group_selection.hide();
	
	$cont_course_selection.hide();
	$cont_branch_selection.hide();
	$cont_semester_selection.hide();
	$cont_session_selection.hide();
	$cont_group_selection.hide();
	
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
		$.ajax({url:site_url("course_structure/add/json_get_branch/"+$course_selection.find(':selected').val()+"/"+$dept_selection.find(
		':selected').val()),
			success:function(data){
				
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
				
				for($d=1926;$d<=n;$d++)
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
		
		if($("#course_selection").val() == "honour" || $("#course_selection").val() == "minor")
		{
			base_str = "<option value = '0'>All</option>";
			for(counter = 5; counter <= 8 ; counter++){
					base_str += "<option value=\""+counter+"\">"+counter+"</option>";
			}
		}
		else
		{
		
			if(duration < 4){
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
		}
		
		$cont_semester_selection.show();
		$semester_selection.show().html(base_str);
		
		if($dept_selection.find(':selected').val() == 'comm')
		{		
			base_str_group = "";
			base_str_group += "<option value = '1'>Group 1</option>";
			base_str_group += "<option value = '2'>Group 2</option>";
			
			$("#cont_group").show();
			$("#group_selection").show().html(base_str_group);
		}
		
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

});