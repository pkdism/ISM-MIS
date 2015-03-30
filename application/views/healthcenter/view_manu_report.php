<?php echo form_open('healthcenter/view_manu_report/show_manu',array("id"=>"rc_manu")); ?>

<div class="row">
	<div class="col-md-6 col-md-offset-2  ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	
                    
                  
	<div class="box box-solid box-primary">
	
				<div class="box-header">
					<h3 class="box-title">Manufacturer Report</h3>
				</div>
				
				<div class="box-body">
				
						<div class="row">
							
							<div class="col-md-12">
								<div class="form-group">
									<label for="manu">Manufacturer</label>
									
									<select name="manuDrp" id="manuDrp" class="form-control" >
										<option value="0" selected="selected">Select Manufacturer</option>

										<?php foreach($manu_list as $r):?>
										<option value="<?php echo $r->manu_id?>"><?php echo $r->manu_name?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<label for="from">Date From</label>
											<input type="text" id="from" name="from" class="form-control" data-date-format="dd M yyyy">
										</div>
										<div class="col-sm-6">
											<label for="to">Date to</label>
											<input type="text" id="to" name="to" class="form-control"data-date-format="dd M yyyy">
									</div>
								</div>
								</div>
							</div>
							
							
						
						</div>
									
				</div>
				<div class="box-footer">
							<div class="row">
								<div class="col-md-8">
									<button type="submit" class="btn btn-primary" id="b_sub">Submit</button>
								</div>
								</div>
							
				</div>
				
	
		</div>
		
	</div>
</div>
<?php echo form_close(); ?>
<style>
.box-primary{
	border:1px groove #3c8dbc !important;
}
</style>
<script type="text/javascript">  
   $(document).ready(function() {  
                 
			   
			   
			   $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
		});  
		</script>
