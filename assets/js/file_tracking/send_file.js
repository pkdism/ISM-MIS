$(document).ready(function(){	
	$("select[name='type']").on('change', function() {
            
		$.ajax({url : site_url("file_tracking/send_new_file_ajax/get_dept/"+this.value),
				success : function (result) {
					$('#department_name').html(result);
				}});
	});

	$('#department_name').on('change', function() {
		$.ajax({url : site_url("file_tracking/send_new_file_ajax/get_designation/"+this.value),
				success : function (result) {
					$('#designation').html(result);
				}});
	});
	$('#designation').on('change', function() {
		$.ajax({url : site_url("file_tracking/send_new_file_ajax/get_emp_name/"+$(this).val()+"/"+$('#department_name').val()),
				success : function (result) {
					$('#emp_name').html(result);
				}});	
	});
});