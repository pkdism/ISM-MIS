$(document).ready(function() {
	$("#remove-guards").hide();
	var guards = JSON.parse('<?php echo json_encode($guards); ?>');
	console.log(guards);
	
	var shiftMap = {
			a: 'c',
			b: 'a',
			c: 'b'
	};
	$("#filltoday").click(function() {
		guards.forEach(function(guard){
			$("#guard-"+guard.Regno).each(function() {
				$(this).find("[name=postname_"+guard.Regno+"c]").val(guard.post_id);
				$(this).find("[name=shift_"+guard.Regno+"c]").val(guard.shift);
			});
		});
	});
	
	$("#autofill").click(function() {
		guards.forEach(function(guard){
			$("#guard-"+guard.Regno).each(function() {
				$(this).find("[name=postname_"+guard.Regno+"]").val(guard.post_id);
				$(this).find("[name=shift_"+guard.Regno+"]").val(shiftMap[guard.shift]);
			});
		});
	});
	
	$("#reset").click(function() {
		guards.forEach(function(guard){
			$("#guard-"+guard.Regno).each(function() {
				$(this).find("[name=postname_"+guard.Regno+"]").val("");
				$(this).find("[name=shift_"+guard.Regno+"]").val("");
			});
		});
	});
		
	$(".remove-checkbox").on('ifChanged',function() {
		if($("input[type=checkbox]:checked.remove-checkbox").length){
			$("#remove-guards").show();
			$("#assign").hide();
		} else {
			$("#remove-guards").hide();
			$("#assign").show();
		}
	});
	$("#remove-guards").click(function(){
		if(!confirm("Are you sure you want to remove the selected guard(s)?")){
			return;
		}
		$("input[type=checkbox]:checked.remove-checkbox").each(function() {
			$(this).closest(".row-guard").remove();
		});
		$(this).hide();
		$("#assign").show();
	});
	
});