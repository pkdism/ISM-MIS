<?php echo form_open('healthcenter/view_stock_report/show_medi',array("id"=>"rc_medi")); ?>

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
					<h3 class="box-title">Medicine Stock Report</h3>
				</div>
				
				<div class="box-body">
				
						<div class="row">
							
							<div class="col-md-12">
								<div class="form-group">
									<label for="manu">Medicine</label>
									
									<select name="mediDrp" id="mediDrp" class="form-control" >
										<option value="0" selected="selected">Select Medicine</option>

										<?php foreach($manu_list as $r):?>
										<option value="<?php echo $r->m_id?>"><?php echo $r->m_name?></option>
										<?php endforeach;?>
									</select>
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
