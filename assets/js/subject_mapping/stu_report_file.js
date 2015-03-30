$(document).ready(function(){	
	
		$.ajax({url : site_url("student_view_report/report_new_file_ajax/get_dept"),
				success : function (result) {
					$('#department_name').html(result);
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
		
		$('#branch').on('change', function(){
			
				$.ajax({
						url: site_url('subject_mapping/main/showMappingStatus/'+this.value+'/'+$("select[name='course']").val()+'/'+$("select[name='department_name']").val()),
						success: function(data){
								$('#msg .row').html('');
								$('.breadcrumb').hide();
								if(data.length > 5){
								$('#msg .row').html("<div class='col-sm-12'><b>Mapping already done of blow Smester(s)</b></div>");
								var obj = $.parseJSON(data);
									$.each(obj,function(key,value){
										$('#msg .row').append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-red">'+value.semester+'</span>');
										
									});
								}
						}
				});
		});

				
	
});

