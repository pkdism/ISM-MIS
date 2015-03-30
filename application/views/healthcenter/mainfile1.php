<?php echo form_open('healthcenter/mainfile/fin_year'); ?>

<div class="row">
	<div class="col-md-12  ">
	
	<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">Health Center Main Menu</h3>
				</div>
				<div class="box-body">
				
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="addfy" checked="checked"  />
									<label for="afinyear">Add Financial Year</label>
															
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="viewfy"  />
									<label for="vfinyear">View Financial Year</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="addmanu"   />
									<label for="addhcmanu">Add Manufacturer </label>
															
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="viewmanu"  />
									<label for="viewhcmanu">View Manufacturer </label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="addsupp"   />
									<label for="addhcmanu">Add Supplier </label>
															
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="viewsupp"  />
									<label for="viewhcmanu">View Supplier </label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="smmapp"   />
									<label for="addhcmanu">Supplier Manufacturer Mapping </label>
															
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="viewsmmapp"   />
									<label for="addhcmanu">Supplier Manufacturer Mapping </label>
															
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="addmedi"   />
									<label for="addhcmanu">Add Medicine </label>
															
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="viewmedi"   />
									<label for="addhcmanu">View Medicine </label>
															
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="addindent"   />
									<label for="addhcmanu">Make Indent </label>
															
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="viewindent"   />
									<label for="addhcmanu">View Indent </label>
															
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="editindent"   />
									<label for="addhcmanu">Edit Indent </label>
															
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="addpo"   />
									<label for="addhcmanu">Issue Purchase Order </label>
															
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="viewpo"   />
									<label for="addhcmanu">View Purchase Order </label>
															
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="addmrec"   />
									<label for="addhcmanu">Receive Medicine </label>
															
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<input type="radio" name="hcmain" value="viewmrec"   />
									<label for="addhcmanu">View Received Medicine </label>
															
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





