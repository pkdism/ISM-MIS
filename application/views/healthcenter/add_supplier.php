<?php echo form_open('healthcenter/add_supplier'); ?>

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
					<h3 class="box-title">Supplier Details</h3>
				</div>
				<div class="box-body">
				
				<div class="row">
				<div class="col-md-6">
					<div class="panel panel-info">
					   <div class="panel-heading">
						  <h3 class="panel-title">Supplier</h3>
					   </div>
					   <div class="panel-body">
						  <div class="col-md-6">
						<div class="form-group">
							<label for="suppliername">Supplier Name</label>
							<?php echo form_input(array('name'=>'supname','id'=>'supname','placeholder'=>'Supplier Name','class'=>'form-control',)) ?>
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label for="phno">Office Phone Number</label>
							<?php echo form_input(array('name'=>'phno','id'=>'phno','placeholder'=>'Enter Phone no ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="cperson">Contact Person Name</label>
							<?php echo form_input(array('name'=>'cperson','id'=>'cperson','placeholder'=>'Contact Person Name  ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="cpmobile">Contact Person Mobile No.</label>
							<?php echo form_input(array('name'=>'cpersonmob','id'=>'cpersonmob','placeholder'=>'Contact Person Mobile No.  ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="cpmobile">Email-ID</label>
							<?php echo form_input(array('name'=>'semailid','id'=>'semailid','placeholder'=>'Contact Person Email ID.  ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="bifcs">PAN Card Number</label>
							<?php echo form_input(array('name'=>'pannum','id'=>'pannum','placeholder'=>'PAN Number  ','class'=>'form-control',)) ?>
						</div>
					</div>
						
						
					   </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-info">
					   <div class="panel-heading">
						  <h3 class="panel-title">Address</h3>
					   </div>
					   <div class="panel-body">
					   <div class="col-md-6">
						<div class="form-group">
							<label for="address1">Address1</label>
							<?php echo form_input(array('name'=>'add1','id'=>'add1','placeholder'=>' Address ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="address2">Address2</label>
							<?php echo form_input(array('name'=>'add2','id'=>'add2','placeholder'=>' Address ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="address3">Address3</label>
							<?php echo form_input(array('name'=>'add3','id'=>'add3','placeholder'=>' Address','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="city">City</label>
							<?php echo form_input(array('name'=>'city','id'=>'city','placeholder'=>' City ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="state">State</label>
							
							<select name="selstate" class="form-control" >
										<option value="none" selected="selected">Select State</option>

										<?php foreach($states as $r):?>
										<option value="<?php echo $r->name?>"><?php echo $r->name?></option>
										<?php endforeach;?>
									</select>
							
						</div>
										
					</div>
						  
					   </div>
					</div>
				</div>
									
				</div>
				
					<div class="row">
				<div class="col-md-6">
					<div class="panel panel-info">
					   <div class="panel-heading">
						  <h3 class="panel-title">Business</h3>
					   </div>
					   <div class="panel-body">
						  
						  <div class="col-md-4">
					<div class="form-group">
							<label for="tinno">Tin Number</label>
							<?php echo form_input(array('name'=>'tinno','id'=>'tinno','placeholder'=>'Enter TIn No. ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="cstno">CST Number</label>
							<?php echo form_input(array('name'=>'cstno','id'=>'cstno','placeholder'=>'Enter CST No. ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="dlno">DL Number</label>
							<?php echo form_input(array('name'=>'dlno','id'=>'dlno','placeholder'=>'Enter Drug Licence No. ','class'=>'form-control',)) ?>
						</div>
					</div>
						  
						  
					   </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-info">
					   <div class="panel-heading">
						  <h3 class="panel-title">Bank Details</h3>
					   </div>
					   <div class="panel-body">
						  
						  <div class="col-md-4">
						<div class="form-group">
							<label for="bname">Bank Name.</label>
							<?php echo form_input(array('name'=>'bname','id'=>'bname','placeholder'=>'Bank Name.  ','class'=>'form-control',)) ?>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<label for="baccno">Bank Account Number</label>
							<?php echo form_input(array('name'=>'baccno','id'=>'baccno','placeholder'=>'Bank Account No.  ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="bifcs">Bank IFCS Code</label>
							<?php echo form_input(array('name'=>'bifcs','id'=>'bifcs','placeholder'=>'Bank Account No.  ','class'=>'form-control',)) ?>
						</div>
					</div>
					
						  
						  
					   </div>
					</div>
				</div>
									
				</div>
				
				</div>
				
				<div class="box-footer">
				<?php  echo form_submit('submit','Submit','class="btn btn-primary"'); ?>
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
