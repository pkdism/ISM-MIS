$(document).ready(function(){
	$('select[name="mode"]').change(function(){
		var value  = this.value;
		if(value==''){
			return;
		}
		$("#postname, #date, #rangeofdates, #rangeofdates_postname, #rangeofdates_guard").hide();
		$("#" + value).show();
	});
	// $('select[name="mode"]').val("<?php if(isset($mode)) echo $mode; ?>").trigger('change');
	// $('select[name="postname"]').val("<?php if(isset($postname)) echo $postname;?>");
	// $('select[name="postnamer"]').val("<?php if(isset($postnamer)) echo $postnamer;?>");
	// $('select[name="guardname"]').val("<?php if(isset($guardname)) echo $guardname;?>");
	// $('#selectdate').val("<?php if(isset($selectdate)) echo $selectdate; else echo date("Y-m-d");?>");
	// $('#fromdate').val("<?php if(isset($fromdate)) echo $fromdate; else echo date("Y-m-d");?>");
	// $('#fromdateg').val("<?php if(isset($fromdateg)) echo $fromdateg; else echo date("Y-m-d");?>");
	// $('#fromdatep').val("<?php if(isset($fromdatep)) echo $fromdatep; else echo date("Y-m-d");?>");
	// $('#todate').val("<?php if(isset($todate)) echo $todate; else echo date("Y-m-d");?>");
	// $('#todateg').val("<?php if(isset($todateg)) echo $todateg; else echo date("Y-m-d");?>");
	// $('#todatep').val("<?php if(isset($todatep)) echo $todatep; else echo date("Y-m-d");?>");
});

$(document).ready(function() {
	$("#postDutyChartBox").hide();
	$("#postsubmit").click(function(){
		$("#dateDutyChartBox").hide();
		$("#rangepostDutyChartBox").hide();
		$("#rangeDutyChartBox").hide();
		$("#rangeguardDutyChartBox").hide();
		//alert(document.getElementById("post_id").value);
		// Show the loading gif before sending the request
		$("#postDutyChartBox").show();
		var div = document.getElementById("post-div");
		var mylist = document.getElementById("post_id");
		// document.getElementById("demo").value = mylist.options[mylist.selectedIndex].text;
		div.innerHTML = '( '+mylist.options[mylist.selectedIndex].text+' )';
		$("#postDutyChartBox").showLoading();
		$.ajax({
			url: site_url("guard/home/loadpostDutyChart/" + document.getElementById("post_id").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				var $usersTable = $("#postDutyChartTable").dataTable();
				$usersTable.fnClearTable();
				var data = [];
				for(var i = 0; i < users.length; i++) {
					data[i] = [
						'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets//images//guard//' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',
						'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',				
						'<center>'+users[i].shift.toUpperCase()+'</center>',
						'<center>'+moment(users[i].date).format('DD MMM YYYY')+'</center>'
					];
				}
				if(users.length == 0){
					$("#postmessage-div").show();
					$("#postDutyChartTableRow").hide();
				}
				else{
					$("#postmessage-div").hide();
					$("#postDutyChartTableRow").show();
					$usersTable.fnAddData(data);
				}
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#postDutyChartBox").hideLoading();
		});
		$.ajax({
			url: site_url("guard/home/loadpostDutyChartOvertime/" + document.getElementById("post_id").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				var $usersTable = $("#postDutyChartTableOvertime").dataTable();
				$usersTable.fnClearTable();
				var data = [];
				var totalduration =0;
				for(var i = 0; i < users.length; i++) {
					var to="AM"; var from ="AM";
					var totime = users[i].to_time;
					var fromtime = users[i].from_time;
					var duration=totime - fromtime;
					totalduration+=duration;
					if(duration < 0)
						duration = duration +24;
					if(Math.floor(totime) == totime)
					{
						if(totime > 12){
							totime = totime -12;
							to = totime.toString()+":00 PM";
						}
						else{
							to = totime.toString()+":00 AM";
						}
					}
					else
					{
						if(totime > 12){
							totime = Math.floor(totime -12);
							to = totime.toString()+":30 PM";
						}
						else{
							totime = Math.floor(totime);
							to = totime.toString()+":30 AM";
						}
					}
					if(Math.floor(fromtime) == fromtime)
					{
						if(fromtime > 12){
							fromtime = fromtime -12;
							from = fromtime.toString()+":00 PM";
						}
						else{
							from = fromtime.toString()+":00 AM";
						}
					}
					else
					{
						if(fromtime > 12){
							fromtime = Math.floor(fromtime -12);
							from = fromtime.toString()+":30 PM";
						}
						else{
							fromtime = Math.floor(fromtime);
							from = fromtime.toString()+":30 AM";
						}
					}
					data[i] = [
						'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets//images//guard//' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',
						'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',				
						'<center>'+from+'</center>',
						'<center>'+to+'</center>',
						'<center>'+duration+' Hours</center>',
						'<center>'+moment(users[i].date).format('DD MMM YYYY')+'</center>'
					];
				}
				if(users.length == 0){
					$("#postmessageO-div").show();
					$("#postDutyChartTableOvertimeRow").hide();
					$("#totalduration").hide();
				}
				else{
					$("#postmessageO-div").hide();
					$("#postDutyChartTableOvertimeRow").show();
					$("#totalduration").html('<center><b>Total Overtime Working Hours: '+totalduration+' Hours</b></center>'); 
					$usersTable.fnAddData(data);
				}
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#postDutyChartBox").hideLoading();
		});
	});
});

$(document).ready(function() {
	$("#dateDutyChartBox").hide();
	$("#datesubmit").click(function(){
		$("#rangeguardDutyChartBox").hide();
		$("#rangepostDutyChartBox").hide();
		$("#rangeDutyChartBox").hide();
		$("#postDutyChartBox").hide();
		// Show the loading gif before sending the request
		$("#dateDutyChartBox").show();
		var div = document.getElementById("date-div");
		var mylist = document.getElementById("selectdate").value;
		// document.getElementById("demo").value = mylist.options[mylist.selectedIndex].text;
		div.innerHTML = moment(mylist).format("DD MMM YYYY");
		$("#dateDutyChartBox").showLoading();
		$.ajax({
			url: site_url("guard/home/loaddateDutyChart/" + document.getElementById("selectdate").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				var $usersTable = $("#dateDutyChartTable").dataTable();
				$usersTable.fnClearTable();
				var data = [];
				for(var i = 0; i < users.length; i++) {
					data[i] = [
						'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets//images//guard//' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',
						'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',				
						'<center>'+users[i].postname+'</center>',
						'<center>'+users[i].shift.toUpperCase()+'</center>'
					];
				}
				if(users.length == 0){
					$("#datemessage-div").show();
					$("#dateDutyChartTableRow").hide();
				}
				else{
					$("#datemessage-div").hide();
					$("#dateDutyChartTableRow").show();
					$usersTable.fnAddData(data);
				}
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#dateDutyChartBox").hideLoading();
		});
		
		$.ajax({
			url: site_url("guard/home/loaddateDutyChartOvertime/" + document.getElementById("selectdate").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				var $usersTable = $("#dateDutyChartTableOvertime").dataTable();
				$usersTable.fnClearTable();
				var data = [];
				var totaldurationd =0;
				for(var i = 0; i < users.length; i++) {
					var to="AM"; var from ="AM";
					var totime = users[i].to_time;
					var fromtime = users[i].from_time;
					var duration=totime - fromtime;
					totaldurationd+=duration;
					if(duration < 0)
						duration = duration +24;
					if(Math.floor(totime) == totime)
					{
						if(totime > 12){
							totime = totime -12;
							to = totime.toString()+":00 PM";
						}
						else{
							to = totime.toString()+":00 AM";
						}
					}
					else
					{
						if(totime > 12){
							totime = Math.floor(totime -12);
							to = totime.toString()+":30 PM";
						}
						else{
							totime = Math.floor(totime);
							to = totime.toString()+":30 AM";
						}
					}
					if(Math.floor(fromtime) == fromtime)
					{
						if(fromtime > 12){
							fromtime = fromtime -12;
							from = fromtime.toString()+":00 PM";
						}
						else{
							from = fromtime.toString()+":00 AM";
						}
					}
					else
					{
						if(fromtime > 12){
							fromtime = Math.floor(fromtime -12);
							from = fromtime.toString()+":30 PM";
						}
						else{
							fromtime = Math.floor(fromtime);
							from = fromtime.toString()+":30 AM";
						}
					}
					data[i] = [
						'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets//images//guard//' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',
						'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',				
						'<center>'+users[i].postname+'</center>',
						'<center>'+from+'</center>',
						'<center>'+to+'</center>',
						'<center>'+duration+' Hours</center>'
					];
				}
				if(users.length == 0){
					$("#datemessageO-div").show();
					$("#dateDutyChartTableOvertimeRow").hide();
					$("#totaldurationd").hide();
				}
				else{
					$("#datemessageO-div").hide();
					$("#dateDutyChartTableOvertimeRow").show();
					$("#totaldurationd").html('<center><b>Total Overtime Working Hours: '+totaldurationd+' Hours</b></center>'); 
					$usersTable.fnAddData(data);
				}
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#dateDutyChartBox").hideLoading();
		});
	});
});

$(document).ready(function() {
	$("#rangeDutyChartBox").hide();
	$("#rangesubmit").click(function(){
		$("#dateDutyChartBox").hide();
		$("#rangepostDutyChartBox").hide();
		$("#rangeguardDutyChartBox").hide();
		$("#postDutyChartBox").hide();
		//alert(document.getElementById("post_id").value);
		// Show the loading gif before sending the request
		$("#rangeDutyChartBox").show();
		var div = document.getElementById("range-div");
		// document.getElementById("demo").value = mylist.options[mylist.selectedIndex].text;
		div.innerHTML = moment(document.getElementById("fromdate").value).format("DD MMM YYYY")+" to "+moment(document.getElementById("todate").value).format("DD MMM YYYY");
		$("#rangeDutyChartBox").showLoading();
		$.ajax({
			url: site_url("guard/home/loadrangeDutyChart/" + document.getElementById("fromdate").value+"/"+ document.getElementById("todate").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				var $usersTable = $("#rangeDutyChartTable").dataTable();
				$usersTable.fnClearTable();
				var data = [];
				for(var i = 0; i < users.length; i++) {
					data[i] = [
						'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets//images//guard//' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',
						'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',				
						'<center>'+users[i].postname+'</center>',
						'<center>'+users[i].shift.toUpperCase()+'</center>',
						'<center>'+moment(users[i].date).format('DD MMM YYYY')+'</center>'
					];
				}
				if(users.length == 0){
					$("#rangemessage-div").show();
					$("#rangeDutyChartTableRow").hide();
				}
				else{
					$("#rangemessage-div").hide();
					$("#rangeDutyChartTableRow").show();
					$usersTable.fnAddData(data);
				}
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#rangeDutyChartBox").hideLoading();
		});
		
		$.ajax({
			url: site_url("guard/home/loadrangeDutyChartOvertime/" + document.getElementById("fromdate").value+"/"+ document.getElementById("todate").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				var $usersTable = $("#rangeDutyChartTableOvertime").dataTable();
				$usersTable.fnClearTable();
				var data = [];
				var totaldurationr =0;
				for(var i = 0; i < users.length; i++) {
					var to="AM"; var from ="AM";
					var totime = users[i].to_time;
					var fromtime = users[i].from_time;
					var duration=totime - fromtime;
					totaldurationr+=duration;
					if(duration < 0)
						duration = duration +24;
					if(Math.floor(totime) == totime)
					{
						if(totime > 12){
							totime = totime -12;
							to = totime.toString()+":00 PM";
						}
						else{
							to = totime.toString()+":00 AM";
						}
					}
					else
					{
						if(totime > 12){
							totime = Math.floor(totime -12);
							to = totime.toString()+":30 PM";
						}
						else{
							totime = Math.floor(totime);
							to = totime.toString()+":30 AM";
						}
					}
					if(Math.floor(fromtime) == fromtime)
					{
						if(fromtime > 12){
							fromtime = fromtime -12;
							from = fromtime.toString()+":00 PM";
						}
						else{
							from = fromtime.toString()+":00 AM";
						}
					}
					else
					{
						if(fromtime > 12){
							fromtime = Math.floor(fromtime -12);
							from = fromtime.toString()+":30 PM";
						}
						else{
							fromtime = Math.floor(fromtime);
							from = fromtime.toString()+":30 AM";
						}
					}
					data[i] = [
						'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets//images//guard//' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',
						'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',				
						'<center>'+users[i].postname+'</center>',
						'<center>'+from+'</center>',
						'<center>'+to+'</center>',
						'<center>'+duration+' Hours</center>',
						'<center>'+moment(users[i].date).format('DD MMM YYYY')+'</center>'
					];
				}
				if(users.length == 0){
					$("#rangemessageO-div").show();
					$("#rangeDutyChartTableOvertimeRow").hide();
					$("#totaldurationr").hide();
				}
				else{
					$("#rangemessageO-div").hide();
					$("#rangeDutyChartTableOvertimeRow").show();
					$("#totaldurationr").html('<center><b>Total Overtime Working Hours: '+totaldurationr+' Hours</b></center>'); 
					$usersTable.fnAddData(data);
				}
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#rangeDutyChartBox").hideLoading();
		});
	});
});

$(document).ready(function() {
	$("#rangepostDutyChartBox").hide();
	$("#rangepostsubmit").click(function(){
		if(document.getElementById("postnamer").value=="")
		{
			alert("Warning!, Post Name can't be null");
			return false;
		}
		$("#dateDutyChartBox").hide();
		$("#rangeguardDutyChartBox").hide();
		$("#rangeDutyChartBox").hide();
		$("#postDutyChartBox").hide();
		//alert(document.getElementById("post_id").value);
		// Show the loading gif before sending the request
		$("#rangepostDutyChartBox").show();
		var div = document.getElementById("rangepost-div");
		var mylist = document.getElementById("postnamer");
		
		div.innerHTML = moment(document.getElementById("fromdatep").value).format("DD MMM YYYY")+" to "+moment(document.getElementById("todatep").value).format("DD MMM YYYY")+" at Post "+mylist.options[mylist.selectedIndex].text; 
		$("#rangepostDutyChartBox").showLoading();
		$.ajax({
			url: site_url("guard/home/loadrangepostDutyChart/" + document.getElementById("fromdatep").value + "/" + document.getElementById("todatep").value + "/"+document.getElementById("postnamer").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				var $usersTable = $("#rangepostDutyChartTable").dataTable();
				$usersTable.fnClearTable();
				var data = [];
				for(var i = 0; i < users.length; i++) {
					data[i] = [
						'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets//images//guard//' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',
						'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',				
						'<center>'+users[i].shift.toUpperCase()+'</center>',
						'<center>'+moment(users[i].date).format('DD MMM YYYY')+'</center>'
					];
				}
				if(users.length == 0){
					$("#rangepostmessage-div").show();
					$("#rangepostDutyChartTableRow").hide();
				}
				else{
					$("#rangepostmessage-div").hide();
					$("#rangepostDutyChartTableRow").show();
					$usersTable.fnAddData(data);
				}
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#rangepostDutyChartBox").hideLoading();
		});
		
		$.ajax({
			url: site_url("guard/home/loadrangepostDutyChartOvertime/" + document.getElementById("fromdatep").value + "/" + document.getElementById("todatep").value + "/"+document.getElementById("postnamer").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				var $usersTable = $("#rangepostDutyChartTableOvertime").dataTable();
				$usersTable.fnClearTable();
				var data = [];
				var totaldurationrp = 0;
				for(var i = 0; i < users.length; i++) {
					var to="AM"; var from ="AM";
					var totime = users[i].to_time;
					var fromtime = users[i].from_time;
					var duration=totime - fromtime;
					totaldurationrp+=duration;
					if(duration < 0)
						duration = duration +24;
					if(Math.floor(totime) == totime)
					{
						if(totime > 12){
							totime = totime -12;
							to = totime.toString()+":00 PM";
						}
						else{
							to = totime.toString()+":00 AM";
						}
					}
					else
					{
						if(totime > 12){
							totime = Math.floor(totime -12);
							to = totime.toString()+":30 PM";
						}
						else{
							totime = Math.floor(totime);
							to = totime.toString()+":30 AM";
						}
					}
					if(Math.floor(fromtime) == fromtime)
					{
						if(fromtime > 12){
							fromtime = fromtime -12;
							from = fromtime.toString()+":00 PM";
						}
						else{
							from = fromtime.toString()+":00 AM";
						}
					}
					else
					{
						if(fromtime > 12){
							fromtime = Math.floor(fromtime -12);
							from = fromtime.toString()+":30 PM";
						}
						else{
							fromtime = Math.floor(fromtime);
							from = fromtime.toString()+":30 AM";
						}
					}
					data[i] = [
						'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets//images//guard//' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',
						'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',				
						'<center>'+from+'</center>',
						'<center>'+to+'</center>',
						'<center>'+duration+' Hours</center>',
						'<center>'+moment(users[i].date).format('DD MMM YYYY')+'</center>'
					];
				}
				if(users.length == 0){
					$("#rangepostmessageO-div").show();
					$("#rangepostDutyChartTableOvertimeRow").hide();
					$("#totaldurationrp").hide();
				}
				else{
					$("#rangepostmessageO-div").hide();
					$("#rangepostDutyChartTableOvertimeRow").show();
					$("#totaldurationrp").html('<center><b>Total Overtime Working Hours: '+totaldurationrp+' Hours</b></center>'); 
					$usersTable.fnAddData(data);
				}
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#rangepostDutyChartBox").hideLoading();
		});
	});
});

$(document).ready(function() {
	$("#rangeguardDutyChartBox").hide();
	$("#rangeguardsubmit").click(function(){
		if(document.getElementById("guardname").value=="")
		{
			alert("Warning!, Guard Name can't be null");
			return false;
		}
		$("#dateDutyChartBox").hide();
		$("#rangepostDutyChartBox").hide();
		$("#rangeDutyChartBox").hide();
		$("#postDutyChartBox").hide();
		//alert(document.getElementById("post_id").value);
		// Show the loading gif before sending the request
		$("#rangeguardDutyChartBox").show();
		var div = document.getElementById("rangeguard-div");
		var mylist = document.getElementById("guardname");
		
		div.innerHTML = moment(document.getElementById("fromdateg").value).format("DD MMM YYYY")+" to "+moment(document.getElementById("todateg").value).format("DD MMM YYYY")+" for Guard "+mylist.options[mylist.selectedIndex].text;
		$("#rangeguardDutyChartBox").showLoading();
		$.ajax({
			url: site_url("guard/home/loadrangeguardDutyChart/" + document.getElementById("fromdateg").value + "/" + document.getElementById("todateg").value + "/"+document.getElementById("guardname").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				if(users.length>0)
					div.innerHTML += "<div style='height: 30px; width: 30px; background-image: url("+base_url()+"assets/images/guard/"+users[0].photo+"); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat; float: right; margin-left: 10px;' data-photo-url='"+base_url()+"assets/images/guard/"+users[0].photo+"' class='print-no-display photo-zoom'></div>"; 
				var $usersTable = $("#rangeguardDutyChartTable").dataTable();
				$usersTable.fnClearTable();
				var data = [];
				for(var i = 0; i < users.length; i++) {
					data[i] = [
						'<center>'+users[i].postname+'</center>',				
						'<center>'+users[i].shift.toUpperCase()+'</center>',
						'<center>'+moment(users[i].date).format('DD MMM YYYY')+'</center>'
					];
				}
				if(users.length == 0){
					$("#rangeguardmessage-div").show();
					$("#rangeguardDutyChartTableRow").hide();
				}
				else{
					$("#rangeguardmessage-div").hide();
					$("#rangeguardDutyChartTableRow").show();
					$usersTable.fnAddData(data);
				}
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#rangeguardDutyChartBox").hideLoading();
		});
		
		$.ajax({
			url: site_url("guard/home/loadrangeguardDutyChartOvertime/" + document.getElementById("fromdateg").value + "/" + document.getElementById("todateg").value + "/"+document.getElementById("guardname").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				var $usersTable = $("#rangeguardDutyChartTableOvertime").dataTable();
				$usersTable.fnClearTable();
				var data = [];
				var totaldurationrg = 0;
				for(var i = 0; i < users.length; i++) {
					var to="AM"; var from ="AM";
					var totime = users[i].to_time;
					var fromtime = users[i].from_time;
					var duration=totime - fromtime;
					totaldurationrg+=duration;
					if(duration < 0)
						duration = duration +24;
					if(Math.floor(totime) == totime)
					{
						if(totime > 12){
							totime = totime -12;
							to = totime.toString()+":00 PM";
						}
						else{
							to = totime.toString()+":00 AM";
						}
					}
					else
					{
						if(totime > 12){
							totime = Math.floor(totime -12);
							to = totime.toString()+":30 PM";
						}
						else{
							totime = Math.floor(totime);
							to = totime.toString()+":30 AM";
						}
					}
					if(Math.floor(fromtime) == fromtime)
					{
						if(fromtime > 12){
							fromtime = fromtime -12;
							from = fromtime.toString()+":00 PM";
						}
						else{
							from = fromtime.toString()+":00 AM";
						}
					}
					else
					{
						if(fromtime > 12){
							fromtime = Math.floor(fromtime -12);
							from = fromtime.toString()+":30 PM";
						}
						else{
							fromtime = Math.floor(fromtime);
							from = fromtime.toString()+":30 AM";
						}
					}
					data[i] = [
						'<center>'+users[i].postname+'</center>',
						'<center>'+from+'</center>',
						'<center>'+to+'</center>',
						'<center>'+duration+' Hours</center>',
						'<center>'+moment(users[i].date).format('DD MMM YYYY')+'</center>'
					];
				}
				if(users.length == 0){
					$("#rangeguardmessageO-div").show();
					$("#rangeguardDutyChartTableOvertimeRow").hide();
					$("#totaldurationrg").hide();
				}
				else{
					$("#rangeguardmessageO-div").hide();
					$("#rangeguardDutyChartTableOvertimeRow").show();
					$("#totaldurationrg").html('<center><b>Total Overtime Working Hours: '+totaldurationrg+' Hours</b></center>'); 
					$usersTable.fnAddData(data);
				}
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#rangeguardDutyChartBox").hideLoading();
		});
	});
});

$(document).ready(function() {
	var showPhoto = function () {
		this.div = $('<div style="border: 2px solid #aaa; position: fixed; height: 300px; width: 300px; min-width: 60px;  background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;"></div>');
		return this;
	}
	showPhoto.prototype = {
		show: function(imageUrl, x, y, xoffset, yoffset, size, screen) {
			var top = y-yoffset;
			if (top + 200 > window.innerHeight) {
				top -= 120;
			}
			this.div.css({
				"background-image": "url('"+imageUrl+"')",
				"top": (top)+"px",
				"left": (x+61-xoffset)+"px",
				"height": "200px",
				"width": parseInt(200*size.width/size.height)+"px"
			});
			$(document.body).append(this.div);
		},
		hide: function() {
			this.div.detach();
		}
	}
	var photo = new showPhoto();
	$("#dateDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		//console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#dateDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	$("#dateDutyChartTableOvertime").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		//console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#dateDutyChartTableOvertime").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	$("#postDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		//console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#postDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	$("#postDutyChartTableOvertime").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		//console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#postDutyChartTableOvertime").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	$("#rangeDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		//console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#rangeDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	$("#rangeDutyChartTableOvertime").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		//console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#rangeDutyChartTableOvertime").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	$("#rangepostDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		//console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#rangepostDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	$("#rangepostDutyChartTableOvertime").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		//console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#rangepostDutyChartTableOvertime").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	$("#rangeguardDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		//console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#rangeguardDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	$("#rangeguard-div").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#rangeguard-div").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
});