$(document).ready(function(){

    var isValidFormData = function () {
      var type = $("select [name='type']").val();
      var departmentName = $('#department_name').val();
      var designation = $('#designation').val();
      var empName = $('#emp_name').val();
      var leaveStartDate = $('#leave_start_date').val();
      var leaveEndDate = $('#leave_end_date').val();

      if (type === 'Select' || departmentName === 'Select' || designation === 'Select' || empName === 'Select') {
        //alert("Fields can't be set to 'Select'");
        return false;
      }

      if (leaveStartDate === '' || leaveEndDate === '') {
          //alert('Date fields can not be empty');
          return false;
      }

      return true;
    };

    var getLeaveHistory = function () {
        $.ajax({
            url : site_url("leave/leave_ajax/get_leave_by_emp_id/"+$('#emp_name').val()+"/"+$('#leave_start_date').val()+"/"+$('#leave_end_date').val()),
            success : function (result) {
                $('#leave_details').html(result);
            }
        });
    };

	$("select[name='type']").on('change', function() {
		$.ajax({url : site_url("leave/leave_ajax/get_dept/"+this.value),
				success : function (result) {
					$('#department_name').html(result);
				}});
	});

	$('#department_name').on('change', function() {
		$.ajax({url : site_url("leave/leave_ajax/get_designation/"+this.value),
				success : function (result) {
					$('#designation').html(result);
				}});
	});

	$('#designation').on('change', function() {
		$.ajax({url : site_url("leave/leave_ajax/get_emp_name/"+$(this).val()+"/"+$('#department_name').val()),
				success : function (result) {
					$('#emp_name').html(result);
				}});	
	});

    $('#emp_name,#leave_start_date,#leave_end_date').on('change', function () {
        if (isValidFormData()) {
            getLeaveHistory();
        }
    });

    //$('#leave_start_date').on('change', function () {
     //   if (isValidFormData()) {
     //       getLeaveHistory();
     //   }
    //});
    //
    //$('#leave_end_date').on('change', function() {
     //   if (isValidFormData()) {
     //       getLeaveHistory();
     //   }
	//});
});




