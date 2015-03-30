<?php echo form_open('healthcenter/add_medicine'); ?>

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
					<h3 class="box-title">Medicine Infomation</h3>
				</div>
				<div class="box-body">
				
				<div class="row">
				<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
					  <h3 class="panel-title">Medicine</h3>
				   </div>
				   <div class="panel-body">
					  
					  <div class="col-md-6">
						<div class="form-group">
							<label for="medicinename">Medicine Name</label>
							<?php echo form_input(array('name'=>'medname','id'=>'medname','placeholder'=>'Medicine Name','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
								<label for="mtype">Type of Medicine</label>
							<?php 
											$options = array(
											  'Select Type'  => 'Select Type',
											  'Tablets'  => 'Tablets',
											  'Capsules'  => 'Capsules',
											  'Injection'  => 'Injection',
											  'Syrups' => 'Syrups',
											  'Inhalants' => 'Inhalants',
											  'Ointments' => 'Ointments',
											 );
											echo form_dropdown('dropdown_menu',  $options, '0','class="form-control" id="dropdown_type"');
								?>
								</div>
						</div>
					
					<div class="col-md-6">
						<div class="form-group">
								<label for="generic">Medicine Group Name</label>
							<?php echo form_input(array('name'=>'gname','id'=>'gname','placeholder'=>'Enter Generic Name ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="mname">Select Manufacturer</label>
									
									<select name="selmanu" class="form-control" >
										<option value="none" selected="selected">Select Manufacturer</option>

										<?php foreach($manu_list as $r):?>
										<option value="<?php echo $r->manu_id?>"><?php echo $r->manu_name?></option>
										<?php endforeach;?>
									</select>
							
						</div>
					</div>
					  
				   </div>
				</div>
				</div>
				<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
					  <h3 class="panel-title">Dose</h3>
				   </div>
				   <div class="panel-body">
					  
					 
					<div class="col-md-6">
						<div class="form-group">
							<label for="adult">Adult Dose</label>
							<?php echo form_input(array('name'=>'adultdose','id'=>'adultdose','placeholder'=>'Enter Adult Dose','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="kid">Kid Dose</label>
							<?php echo form_input(array('name'=>'kiddose','id'=>'kiddose','placeholder'=>'Enter Kid Dose ','class'=>'form-control',)) ?>
						</div>
					</div>
					 <div class="col-md-6">
						<div class="form-group">
							<label for="seffect">Side Effect</label>
							<?php echo form_input(array('name'=>'seffect','id'=>'seffect','placeholder'=>'Enter Side Effect ','class'=>'form-control',)) ?>
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
					  <h3 class="panel-title">Storage</h3>
				   </div>
				   <div class="panel-body">
					  <div class="col-md-12">
						<div class="form-group">
							<label for="rackno">Rack Number</label>
							<?php echo form_input(array('name'=>'rackno','id'=>'rackno','placeholder'=>'Rack Number ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="cabinet">Cabinet Number</label>
							<?php echo form_input(array('name'=>'cabinetno','id'=>'cabinetno','placeholder'=>'Cabinet Number ','class'=>'form-control',)) ?>
						</div>
					</div>
					  
				   </div>
				</div>
				</div>
				<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
					  <h3 class="panel-title">Supply Time</h3>
				   </div>
				   <div class="panel-body">
					  
					  <div class="col-md-6">
						<div class="form-group">
							<label for="threshold">Threshold</label>
							<?php echo form_input(array('name'=>'thresh','id'=>'thresh','placeholder'=>'Threshold ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="cabinet">Standard Supply Time</label>
							<?php echo form_input(array('name'=>'sdelaytm','id'=>'sdelaytm','placeholder'=>'Standard Delay Time','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="cabinet">Current Stock</label>
							<?php echo form_input(array('name'=>'c_stock','id'=>'c_stock','placeholder'=>'Current Stock','class'=>'form-control',)) ?>
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

<?php echo form_close(); ?>

<style>
.box-primary{
	border:1px groove #3c8dbc !important;
}
</style>

