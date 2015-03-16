// JavaScript Document
$(document).ready(function() {
	
	// Show the loading gif before sending the request
	$("#complete").showLoading();
	$.ajax({
		url: site_url("guard/duties/loadcompDutyChart")
	}).done(function(userData) {
		// Process the data
		(function() {
			var users = eval(userData);
			var $usersTable = $("#compDutyChartTable").dataTable();
			var data = [];
			for(var i = 0; i < users.length; i++) {
				data[i] = [
					'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets/images/guard/' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',	
					'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',
					'<center>'+users[i].postname+'</center>',
					'<center>'+users[i].shift.toUpperCase()+'</center>',
					'<center>'+moment(users[i].date).format('DD MMM YYYY')+'</center>'
				];
			}

			$usersTable.fnAddData(data);
		})();
	}).always(function() {
		// Hide the loading gif, when request is complete.
		$("#complete").hideLoading();
	});

});