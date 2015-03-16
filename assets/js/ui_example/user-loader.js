// JavaScript Document
$(document).ready(function() {
	
	// Show the loading gif before sending the request
	$("#usersBox").showLoading();
	$.ajax({
		url: site_url("ui_example/loadUsers")
	}).done(function(userData) {
		// Process the data
		(function() {
			var users = eval(userData);
			var $usersTable = $("#usersTable").dataTable();
			var data = [];
			for(var i = 0; i < users.length; i++) {
				data[i] = [
					users[i].id,
					users[i].salutation,
					users[i].first_name,
					users[i].middle_name,
					users[i].last_name,
					users[i].dept_name
				];
			}

			$usersTable.fnAddData(data);
		})();
	}).always(function() {
		// Hide the loading gif, when request is complete.
		$("#usersBox").hideLoading();
	});

});