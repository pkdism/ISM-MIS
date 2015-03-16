// JavaScript Document
$(document).ready(function() {
	
	// Show the loading gif before sending the request
	$("#today").showLoading();
	$.ajax({
		url: site_url("guard/duties/loaddateDutyChart")
	}).done(function(userData) {
		// Process the data
		(function() {
			var users = eval(userData);
			var $usersTable = $("#dateDutyChartTable").dataTable();
			var data = [];
			for(var i = 0; i < users.length; i++) {
				data[i] = [
					'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets//images//guard//' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',	
					'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',
					'<center>'+users[i].postname+'</center>',
					'<center>'+users[i].shift.toUpperCase()+'</center>',
					'<center><a href="'+base_url()+'index.php/guard/duties/replace/'+users[i].Regno+'/'+users[i].post_id+'/'+users[i].shift+'/'+users[i].date+'" onclick="return confirm(\'Are you sure you want to replace?\')"><button value="Replace" class=" btn btn-primary btn-sm" type="button"><i class="fa fa-exchange"></i>&nbsp; Replace</button></a></center>',
					'<center><a href="'+base_url()+'index.php/guard/duties/remove/'+users[i].Regno+'/'+users[i].post_id+'/'+users[i].shift+'/'+users[i].date+'" onclick="return confirm(\'Are you sure you want to remove?\')"><button value="Remove" class=" btn btn-danger btn-sm" type="button"><i class="fa fa-remove"></i>&nbsp; Remove</button></a></center>'
				];
			}

			$usersTable.fnAddData(data);
		})();
	}).always(function() {
		// Hide the loading gif, when request is complete.
		$("#today").hideLoading();
	});

});