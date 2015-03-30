$(document).ready(function(){	
					
			
		$("select[name=m_id]").on('change', function() {
			
			$.ajax({url : site_url("healthcenter/report_new_file_ajax/get_supplier/"+$("select[name=m_id]").val()),
				success : function (result) {
					$('#suppname').html(result);
				}});
	});


 
	
	
});

