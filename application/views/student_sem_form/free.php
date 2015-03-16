<input type="text" id="test" />
<p id="r"></p>
<script>
$(function(){
	
	$('#test').keyup(function(){
		
		if($(this).val().length < 1){
				$('#r').html('Empty');
				return false;
			} 
		
		$.ajax({
			url: '<?php echo base_url() ?>index.php/student_sem_form/regular_form/ids/1',
			}).done(function(data){
					$('#r').html(data);
				});
	});
	})
</script>