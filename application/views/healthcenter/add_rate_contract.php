

<div class="row">
	<div class="col-md-6 col-md-offset-2  ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	<?php echo form_open('healthcenter/add_rate_contract/insert',array("id"=>"ratecont")); ?>
	
                    
                  
	<div class="box box-solid box-primary">
	<?php echo form_close(); ?>
				<div class="box-header">
					<h3 class="box-title">Rate Contract</h3>
				</div>
				
				<div class="box-body">
				
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="financialyear">Select Medicine</label>
									
					<?php echo form_dropdown('medicineDrp', $medi_list,'','class="form-control" id="medicineDrp"'); ?> 	
									
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="manu">Manufacturer</label>
									<?php echo form_input(array('name'=>'manu','id'=>'manu','class'=>'form-control',)); ?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="manu">Supplier</label>
									<?php echo form_dropdown('suppDrp',  array(), '','class="form-control" id="suppDrp"');?>
								</div>
							</div>
							<div class="col-md-6">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Manufacturer</h3>
								</div>
								<div class="panel-body">
								
										<div class="col-md-12">
											<div class="form-group">
												<label for="dismanu">Discount (In Percentage)</label>
												<?php echo form_input(array('name'=>'dismanu','id'=>'dismanu','class'=>'form-control',)) ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="dismanu">Validity From</label>
												
												<?php echo form_input(array('name'=>'ms_date','id'=>'ms_date','placeholder'=>'Date','class'=>'form-control','data-date-format'=>'dd M yyyy')) ?>
												
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="dismanu">Validity To</label>
												<?php echo form_input(array('name'=>'me_date','id'=>'me_date','placeholder'=>'Date','class'=>'form-control','data-date-format'=>'dd M yyyy')) ?>
											</div>
										</div>
							</div>
							</div>
							</div>
							<div class="col-md-6">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Supplier</h3>
								</div>
								<div class="panel-body">
									<div class="col-md-12">
											<div class="form-group">
												<label for="dismanu">Discount  (In Percentage)</label>
												<?php echo form_input(array('name'=>'dismanu','id'=>'dismanu','class'=>'form-control',)) ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="dismanu">Validity From</label>
												<?php echo form_input(array('name'=>'ss_date','id'=>'ss_date','placeholder'=>'Date','class'=>'form-control','data-date-format'=>'dd M yyyy')) ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="dismanu">Validity To</label>
												<?php echo form_input(array('name'=>'se_date','id'=>'se_date','placeholder'=>'Date','class'=>'form-control','data-date-format'=>'dd M yyyy')) ?>
											</div>
										</div>
								
								
								
								
								</div>
							</div>
							</div>
						
						</div>
									
				</div>
				<div class="box-footer">
							<div class="row">
								<div class="col-md-8">
									<?php  echo form_submit('submit','Submit','class="btn btn-primary"'); ?>
								</div>
								</div>
							
				</div>
				
	
		</div>
		
	</div>
</div>
<style>
.box-primary{
	border:1px groove #3c8dbc !important;
}
</style>
<script type="text/javascript">  
                  $(document).ready(function() {  
                     $("#medicineDrp").change(function(){  
					// alert($(this).val());
					 
					 
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo base_url();?>index.php/healthcenter/add_rate_contract/show_manu",  
                        data: {id:$(this).val()},  
                        type: "POST",  
                        success:function(data){  
                       						
						//alert(data);
						var json = $.parseJSON(data);
    					 $("#manu").val(json.manu_nm[0].manu_name);
						 
						 // Population of Supplier List 
						 var appenddata = "";
						$.each(json.supp_nm, function (key, value) {
							appenddata += "<option value = '" + value.s_id + " '>" + value.s_name + " </option>";                        
						});
						$('#suppDrp').html(appenddata);
						 
						
                     }  
                  });  
               });  
			   
			   $('#ms_date').datepicker(); 
			   $('#me_date').datepicker(); 
			    $('#ss_date').datepicker(); 
			   $('#se_date').datepicker(); 
			  
			   
			   
            });  
         </script>  
