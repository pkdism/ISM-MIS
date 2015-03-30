<?php echo form_open('healthcenter/edit_manufacturer/update'); ?>

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
							<div class="form-group">
							<label for="mname">Select Manufacturer</label>
									
									<select name="selmanu" id="selmanu" class="form-control" >
										<option value="none" selected="selected">Select Manufacturer</option>

										<?php foreach($manu_list as $r):?>
										<option value="<?php echo $r->manu_id?>"><?php echo $r->manu_name?></option>
										<?php endforeach;?>
									</select>
							
						</div>
						</div>
					</div>
				</div>
				
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
					<div class="col-md-12">
						<div class="form-group">
							<label for="mrcperson">Regional Office Contact Person Name</label>
							<?php echo form_input(array('name'=>'m_reg_contact','id'=>'m_reg_contact','placeholder'=>'Regional Contact Person','class'=>'form-control',)) ?>
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
									'id' => 'group',
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
											'id' => 'group',
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
				
				<button type="button" id ="up_btn" class="btn btn-primary">Update</button>
				<button type="button" id ="del_btn" class="btn btn-primary">Delete</button>
				
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


 
				
					$('#selmanu').change(function() {
					var id=$(this).val();
					//alert(id);
					$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/edit_manufacturer/get_data/"+id,
					 success: function(data)
						{
								
								var json = $.parseJSON(data);
								$("#m_name").val(json.show_list[0].manu_name);
								$("#m_address").val(json.show_list[0].manu_address);
								$("#m_cnumber").val(json.show_list[0].manu_con_num);
								$("#m_contact").val(json.show_list[0].manu_con_person);
								$("#m_reg_address").val(json.show_list[0].m_ro_address);
								$("#m_reg__cnumber").val(json.show_list[0].m_ro_con_num);
								$("#m_reg_contact").val(json.show_list[0].m_ro_con_person);
								//$("#group").val(json.show_list[0].m_group);
						}

					 });
					
					
					
					});
					
					
					
					$('#del_btn').click(function(){
						id=$("#selmanu").val();
							//alert(id);
							if(id=="none")
							{
								alert("Please Select Manufacturer");
								return false;
							}
							if(confirm("Do You want to Delete this Record"))
						{
							$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/edit_manufacturer/del_manu/"+id,
					 success: function(data)
						{
							if(data=="1")
								{
									window.location=site_url("healthcenter/mainfile");
								}
						}
						});
						}
						
					
				
					});
					
					$('#up_btn').click(function(){
						id=$("#selmanu").val();
						
						
							if(id=="none")
							{
								alert("Please Select Manufacturer");
								return false;
							}
							
							
							if($("#group:checked").length==0)
							{
								alert("Please Select Group of Manufacturer");
								return false;
							}
							
							
							$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/edit_manufacturer/update_manu/",
					type:"POST",
					data:{"manu_id":id,"m_name":$("#m_name").val(),"m_address":$("#m_address").val(),"m_contact":$("#m_contact").val(),"m_cnumber":$("#m_cnumber").val(),"m_reg_address":$("#m_reg_address").val(),"m_reg_contact":$("#m_reg_contact").val(),"m_reg_cnumber":$("#m_reg_cnumber").val(),"group":$("#group").val()},
					 success: function(data)
						{
								if(data=="1")
								{
									window.location=site_url("healthcenter/mainfile");
								}
								
						}
							});
						
						});
					
					

 });
 </script>
 




