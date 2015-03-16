$(document).ready(function(){	
	
		$.ajax({url : site_url("student_view_report/report_new_file_ajax/get_dept"),
				success : function (result) {
					$('#department_name').html(result);
				}});
			
			$.ajax({url : site_url("student_view_report/report_new_file_ajax/get_state"),
				success : function (result) {
					$('#state').html(result);
				}});

			$.ajax({url : site_url("student_view_report/report_new_file_ajax/get_course"),
				success : function (result) {
					$('#course').html(result);
				}});
			
			
			$.ajax({url : site_url("student_view_report/report_new_file_ajax/get_branch"),
				success : function (result) {
					$('#branch').html(result);
				}});
				
		$("select[name='department_name']").on('change', function() {
		$.ajax({url : site_url("student_view_report/report_new_file_ajax/get_course_dept/"+this.value),
				success : function (result) {
					$('#course').html(result);
				}});
	});
				
				
		$("select[name='course']").on('change', function() {
			$.ajax({url : site_url("student_view_report/report_new_file_ajax/get_branch_bycourse/"+this.value+"/"+$("select[name='department_name']").val()),
				success : function (result) {
					$('#branch').html(result);
				}});
	});

				
	
});

