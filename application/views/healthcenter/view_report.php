<?php echo form_open('healthcenter/all_report/show_report',array("id"=>"report_all",)); ?>

<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
	
	
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	
                    
                  
	<div class="box box-solid box-primary">

				<div class="box-header">
					<h3 class="box-title">Report Details</h3>
				</div>
				
				<div class="box-body">
				
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="manuname">Medicine</label>
									<?Php $medi_list['0']="All";
									ksort($medi_list);									
									?>
									
									<?php echo form_dropdown('m_id', $medi_list,'','class="form-control" id="m_id"' )?>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="manuname">Manufacturer</label>
									
									<select id ="selmanu" name="selmanu" class="form-control" >
										<option value="0" selected="selected">Select </option>

										<?php foreach($manu_list as $r):?>
										<option value="<?php echo $r->manu_id?>"><?php echo $r->manu_name?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="supplier">Supplier</label>
									<?Php $r=array_merge(array(""=>"Select"),$supp_list)?>
									<?php echo form_dropdown('s_id', $r,"",'class="form-control"' )?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="indref">Indent</label>
										<?Php $r=array_merge(array(""=>"Select"),$indent_list)?>
										<?php echo form_dropdown('indent_id', $r,"",'class="form-control"' )?>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="manuname">Emergency Indent </label>
									
									<?Php $r=array_merge(array(""=>"Select"),$emer_list)?>
										<?php echo form_dropdown('indent_id', $r,"",'class="form-control"' )?>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label for="manuname">Purchase Order</label>
									<?Php $r=array_merge(array(""=>"Select"),$po_list)?>
									<?php echo form_dropdown('po_id', $r,"",'class="form-control" id="po_id"' )?>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="manuname">Group </label>
									<?php echo form_dropdown('ind_type', array(""=>"Select","A"=>"Group A","B"=>"Group B"),"",'class="form-control"' )?>
									
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="manuname">Date</label>
									<?php echo form_input(array('name'=>'i_date','id'=>'i_date','placeholder'=>'Date','class'=>'form-control','data-date-format'=>'dd M yyyy')) ?>
									
								</div>
							</div>
							<div class="col-md-4">
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
									<button type="submit" class="btn btn-primary" id="b_sub">Show</button>
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

<script>
  $(function() {
   
  $('#i_date').datepicker(); 
  

 
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

