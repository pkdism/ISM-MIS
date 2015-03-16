function ajax(query_by) {
	var $display_employee = $("#display_employee");
	$("#table_container").hide();
	$("#queryBox").showLoading();
	$.ajax({
		url: site_url("employee/emp_ajax/getEmpBy" + query_by + "/" + $('#query').val())
	}).done(function(emps) {
		var data = [];
		for(var i = 0; i < emps.length; i++) {
			var emp = emps[i];
			data.push(['<a href= "' + site_url('employee/view/index/0/' + emp.id) + '">' + emp.id + '</a>',
					   emp.salutation + '. ' + emp.first_name + ' ' + emp.middle_name + ' ' + emp.last_name]);
		}
		var dispEmployee = $display_employee.dataTable();
		dispEmployee.fnClearTable(data);
		dispEmployee.fnAddData(data);
		$("#table_container").show();
	}).always(function() {
		$("#queryBox").hideLoading();
	});
}

$(document).ready(function() {
	$("#table_container").hide();
});