// JavaScript Document
$(document).ready(function() {
	
	// Show the loading gif before sending the request
	$("#postDutyChartBox").showLoading();
	$.ajax({
		url: site_url("guard/home/loadpostDutyChart/" +document.getElementById(''))
	}).done(function(userData) {
		// Process the data
		(function() {
			var users = eval(userData);
			var $usersTable = $("#postDutyChartTable").dataTable();
			var data = [];
			for(var i = 0; i < users.length; i++) {
				data[i] = [
					users[i].date,
					users[i].firstname +' ' + users[i].lastname,
					users[i].photo,
					users[i].shift
				];
			}

			$usersTable.fnAddData(data);
		})();
	}).always(function() {
		// Hide the loading gif, when request is complete.
		$("#postDutyChartBox").hideLoading();
	});

});