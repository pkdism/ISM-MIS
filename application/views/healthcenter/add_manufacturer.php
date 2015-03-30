<?php echo form_open('healthcenter/add_manufacturer'); ?>

<div class="row">
	<div class="col-md-12  ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">Manufacturer Detail</h3>
				</div>
				<div class="box-body">
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="mname">Manufacturer Name <i style="color:red; font-size:14px;" >*</i></label>
							<?php echo form_input(array('name'=>'m_name','id'=>'m_name','placeholder'=>'Manufacturer Name','class'=>'form-control',)) ?>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<div class="panel panel-info">
						
						<div class="panel-heading">
							<h3 class="panel-title">Head Office</h3>
						</div>
						<div class="panel-body">
						<div class="col-md-12">
						<div class="form-group">
							<label for="maddress">Manufacturer Address</label>
							<?php echo form_input(array('name'=>'m_address','id'=>'m_address','placeholder'=>'Address','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="mcnumber">Manufacturer Contact Number</label>
							<?php echo form_input(array('name'=>'m_cnumber','id'=>'m_cnumber','placeholder'=>'Contact Number','class'=>'form-control',)) ?>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group">
							<label for="mcperson">Manufacturer Contact Person Name</label>
							<?php echo form_input(array('name'=>'m_contact','id'=>'m_contact','placeholder'=>'Contact Person','class'=>'form-control',)) ?>
						</div>
					</div>
						
						
						
						
						</div>
					</div>
					</div>
					
				<div class="col-md-6">
				<div class="panel panel-info">
						
						<div class="panel-heading">
							<h3 class="panel-title">Regional Office</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-12">
						<div class="form-group">
							<label for="mrcperson">Regional Office Contact Person Name</label>
							<?php echo form_input(array('name'=>'m_reg_contact','id'=>'m_reg_contact','placeholder'=>'Regional Contact Person','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="mroaddress">Manufacturer Regional Office Address</label>
							<?php echo form_input(array('name'=>'m_reg_address','id'=>'m_reg_address','placeholder'=>'Regional Address','class'=>'form-control',)) ?>
						</div>
					</div>
					
					
					
					<div class="col-md-12">
						<div class="form-group">
							<label for="mrcnumber">Regional Office Contact Number</label>
							<?php echo form_input(array('name'=>'m_reg__cnumber','id'=>'m_reg__cnumber','placeholder'=>'Regional Office Number','class'=>'form-control',)) ?>
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
						<h3 class="panel-title">Select Group</h3>
					</div>
					<div class="panel-body">
					
					<div class="col-md-6">
						
						<div class="row">
						<div class="col-md-6">
						<div class="form-group">
						<?php
													
									//create radio button
									$data_radio1 = array(
									'name' => 'group',
									'value' => 'A',
									);
									echo form_radio($data_radio1);
									echo form_label('&nbsp;&nbsp;Group A');
						
						?>
						</div>
						</div>
							<div class="col-md-6">
								<div class="form-group">
								<?php 
											
											
											$data_radio2 = array(
											'name' => 'group',
											'value' => 'B',
											);
											echo form_radio($data_radio2);
											echo form_label('&nbsp;&nbsp;Group B');
									
									?>
								</div>
							</div>
							</div>
						</div>
						
							
							
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
</div>
	
	

<?php echo form_close(); ?>

<style>
.box-primary{
	border:1px groove #3c8dbc !important;
}
</style>
<script>
$(document).ready(function(){

 $('.group').checkradios();

 });
 </script>
 




