<?php echo form_open('healthcenter/supp_manu_mapping/insert'); ?>

<div class="row">
	<div class="col-md-4 col-md-offset-4 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">Supplier Manufacturer Mapping</h3>
				</div>
				<div class="box-body">
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="supplier">Select Supplier</label>
							
						
									<select name="selsup" class="form-control" >
										<option value="supplist" selected="selected">Select Supplier</option>

										<?php foreach($supp_list as $r):?>
										<option value="<?php echo $r->s_id?>"><?php echo $r->s_name?></option>
										<?php endforeach;?>
									</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="manu">Select Manufacturer</label>
							<select name="selmanu" class="form-control" >
										<option value="manulist" selected="selected">Select Manufacturer</option>

										<?php foreach($manu_list as $r):?>
										<option value="<?php echo $r->manu_id?>"><?php echo $r->manu_name?></option>
										<?php endforeach;?>
									</select>
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





