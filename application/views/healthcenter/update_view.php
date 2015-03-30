

<div class="row">
	<div class="col-md-4 col-md-offset-4 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	<?php echo form_open('healthcenter/add_finyear/update_budget',array("id"=>"fyears")); ?>
	
                   
                  
	<div class="box box-solid box-primary">
	<?php echo form_close(); ?>
				<div class="box-header">
					<h3 class="box-title">Edit Budget</h3>
				</div>
				<?php foreach ($budget_show as $r): ?>
				<div class="box-body">
				
						<div class="row">
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="financialbudget">Budget</label>
								</div>
							</div>
	      					<div class="col-md-6">
								<div class="form-group">
									
									   <input type="text" id="fbudget" name="fbudget" value="<?php echo $r->budget; ?>"><br/> 
									   <input type="hidden" id="budid" name="budid" value="<?php echo $r->budget_id; ?>">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="financialbudget">Budget of Group A</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									
									   <input type="text" id="gabud" name="gabud" value="<?php echo $r->b_groupA; ?>"><br/> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="financialbudget">Budget of Group B</label>
									   
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									
									   <input type="text" id="gbbud" name="gbbud" value="<?php echo $r->b_groupB; ?>"><br/> 
								</div>
							</div>
							
							
							
						</div>
				
						
				</div>
				
                    <?php endforeach; ?>
				<div class="box-footer">
							<div class="row">
								<div class="col-md-8">
									<?php  echo form_submit('submit','Update','class="btn btn-primary"'); ?>
								</div>
								</div>
							
				</div>
				
	
		</div>
		
		
		
		
		
		
	</div>
</div>


<script>

$(document).ready(function(){
	
	$('input[type="submit"]').attr('disabled','disabled');
	
    $("#gbbud").focusout(function() {
    
			$tbud=parseFloat($("#fbudget").val());
			$bud1=parseFloat($("#gabud").val());
			$bud2=parseFloat($("#gbbud").val());
			$tgbud=parseFloat($bud1)+parseFloat($bud2);
			
			if($tbud!=$tgbud)
			{
							
				alert("Group A Budget and Group B Budget Must be equal to Total Budget");
			}
			else
			{
				$('input[type="submit"]').removeAttr('disabled');
            }
			
  });
});
</script>








