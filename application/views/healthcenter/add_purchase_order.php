<?php echo form_open_multipart('healthcenter/add_purchase_order'); ?>

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
					<h3 class="box-title">Enter Purchase Order Details</h3>
				</div>
				<div class="box-body">
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="suppliername">Enter Purchase Order Reference Number</label>
							<?php echo form_input(array('name'=>'po_ref_no','id'=>'po_ref_no','placeholder'=>'Purchase Order Reference No.','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="address1">Purchase Order Date</label>
							<?php echo form_input(array('name'=>'po_date','id'=>'po_date','placeholder'=>'Purchase Order Date ','class'=>'form-control','data-date-format'=>'dd M yyyy')) ?>
						</div>
					</div>
												
			
				
					<div class="col-md-6">
						<div class="form-group">
							<label for="indref">Select Indent Reference Number</label>
							<?php echo form_dropdown('indent_id', $indent_list,"",'class="form-control"' )?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="poremarks">Remarks</label>
							<?php echo form_input(array('name'=>'po_remarks','id'=>'po_remarks','placeholder'=>'Remarks ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="indrefhard">Upload Indent Reference Hard Copy</label>
							<?php echo form_upload(array('name'=>'up_indent','id'=>'up_indent',))?>
						</div>
					</div>
					
					
			
			</div>
				
				<div class="box-footer">
				<?php  echo form_submit('submit','Next','class="btn btn-primary"'); ?>
				</div>
			
			</div>
		</div>
	
	
	
	</div>
</div>

<?php echo form_close(); ?>

<script>
  $(function() {
   
	$('#po_date').datepicker(); 
  });
 </script>

