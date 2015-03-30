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
				<div class="col-md-12">
						<div class="form-group">
							<div class="form-group">
							<label for="mname">Select Medicine</label>
									
									<select name="selmedi" id="selmedi" class="form-control" >
										<option value="none" selected="selected">Select Medicine</option>

										<?php foreach($medi_list as $r):?>
										<option value="<?php echo $r->m_id?>"><?php echo $r->m_name?></option>
										<?php endforeach;?>
									</select>
							
						</div>
						</div>
					</div>
				</div>
				
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
											  '0'  => 'Select Type',
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
								<label for="generic">Generic Name</label>
							<?php echo form_input(array('name'=>'gname','id'=>'gname','placeholder'=>'Enter Generic Name ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
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
				
				<button type="button" id ="up_btn" class="btn btn-primary">Update</button>
				
				
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


 
				
					$('#selmedi').change(function() {
					var id=$(this).val();
					//alert(id);
					$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/edit_medicine/get_data/"+id,
					 success: function(data)
						{
								//alert(data);
								var json = $.parseJSON(data);
								$("#medname").val(json.show_list[0].m_name);
								//$("#dropdown_type option:selected").attr('selected','selected');
								$("#dropdown_type option:contains('"+json.show_list[0].mtype+"')").attr('selected','selected').attr('value');
								$("#gname").val(json.show_list[0].m_generic_nm);
								$("#seffect").val(json.show_list[0].m_sideeffect);
								$("#adultdose").val(json.show_list[0].m_adult_dose);
								$("#kiddose").val(json.show_list[0].m_kids_dose);
								$("#thresh").val(json.show_list[0].threshold);
								$("#rackno").val(json.show_list[0].rack_no);
								$("#cabinetno").val(json.show_list[0].cabi_no);
								//$("#selmanu option:selected").text(json.show_list[0].manu_name).attr('selected','selected');.
								$("#selmanu option:contains('"+json.show_list[0].manu_name+"')").attr('selected','selected').attr('value');
								$("#sdelaytm").val(json.show_list[0].std_del_time);
								$("#c_stock").val(json.show_list[0].c_stock);
						}

					 });
					
					
					
					
					});
					
					
					
					$('#del_btn').click(function(){
						id=$("#selmedi").val();
							//alert(id);
							if(confirm("Do You want to Delete this Record"))
						{
							$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/edit_medicine/del_medi/"+id,
					 success: function(data)
						{
							alert(data);
								if(data=="1")
								{
									window.location=site_url("healthcenter/mainfile");
								}
								if(data=="0")
								{
									alert("Medicine Can not be Deleted.")
								}
								
						}
						});
						}
						
					
				
					});
					
					$('#up_btn').click(function(){
						var i= $("#dropdown_type option:selected").text();
						var j= $("#selmanu option:selected").attr('value');
						id=$("#selmedi").val();
							//alert(id);
							$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/edit_medicine/update_medi/",
					type:"POST",
					
					data:{"m_id":id,"medname":$("#medname").val(),"dropdown_menu":i.toString(),"gname":$("#gname").val(),"seffect":$("#seffect").val(),"adultdose":$("#adultdose").val(),"kiddose":$("#kiddose").val(),"thresh":$("#thresh").val(),"rackno":$("#rackno").val(),"cabinetno":$("#cabinetno").val(),"selmanu":j.toString(),"sdelaytm":$("#sdelaytm").val(),"c_stock":$("#c_stock").val()},
					 success: function(data)
						{
								
								//alert(data);
								if(data=="1")
								{
									window.location=site_url("healthcenter/mainfile");
								}
								
						}
							});
							
							
						
						});
					
					

 });
 </script>

