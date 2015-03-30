<?php echo form_open_multipart('healthcenter/add_indent'); ?>

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
					<h3 class="box-title">Budget Summary</h3>
				</div>
				<div class="box-body">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="indrefno">Financial Year</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<?php echo $fy_list1[0]->curr_fin_year; ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="indrefno">Financial Year Budget</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<?php echo $fy_list1[0]->budget; ?>
								</div>
							</div>
							<div style="clear:both;"></div>
						</div>
						<div class="row">
								<div class="col-md-6">
								<div class="panel panel-info">
									<div class="panel-heading">
									  <h3 class="panel-title">Group A</h3>
								   </div>
								   <div class="panel-body">
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="budget">Budget</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php echo number_format(($fy_list1[0]->b_groupA),2); ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="gaper">Percentage</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php 
																					
											echo number_format((($fy_list1[0]->b_groupA*100)/$fy_list1[0]->budget),2); ?>
										</div>
									</div>
									<div style="clear:both"></div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="gaconsumed">Consumed</label>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<?php echo number_format(($sum_group[0]->gtotal),2); ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="gaper">Percentage</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php 
																					
											echo number_format((($sum_group[0]->gtotal*100)/$fy_list1[0]->budget),2); ?>
										</div>
									</div>
									<div style="clear:both;"></div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="galeft">Left</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php echo number_format((($fy_list1[0]->b_groupA)-($sum_group[0]->gtotal)),2); ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="gaper">Percentage</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php 
																					
											echo number_format(((($fy_list1[0]->b_groupA)-($sum_group[0]->gtotal))*100/($fy_list1[0]->budget)),2); ?>
										</div>
									</div>
									
									
									  
								   </div>
								</div>
								</div>
								
								<div class="col-md-6">
								<div class="panel panel-info">
									<div class="panel-heading">
									  <h3 class="panel-title">Group B</h3>
								   </div>
								   <div class="panel-body">
														 
									<div class="col-md-3">
										<div class="form-group">
											<label for="budget">Budget</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php echo number_format(($fy_list1[0]->b_groupB),2); ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="gaper">Percentage</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php 
																					
											echo number_format((($fy_list1[0]->b_groupB*100)/($fy_list1[0]->budget)),2); ?>
										</div>
									</div>
									<div style="clear:both"></div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="budget">Consumed</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php 
												if($count_row==1)
												{
													echo "0";
												}else
												{
													echo number_format(($sum_group[1]->gtotal),2);
												}
													?>
												
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="gaper">Percentage</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php 
													
												if($count_row==1)
												{
													echo "0";
												}else
												{
													echo number_format((($sum_group[1]->gtotal*100)/($fy_list1[0]->budget)),2);
												}
													
											 ?>
										</div>
									</div>
										<div style="clear:both;"></div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="budget">Left</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php 
											
											if($count_row==1)
												{
													echo "0";
												}else
												{
													echo number_format((($fy_list1[0]->b_groupB)-($sum_group[1]->gtotal)),2); 
												}
											
											?>
											
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="budget">Percentage</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<?php 
											if($count_row==1)
												{
													echo "0";
												}else
												{
													echo number_format(((($fy_list1[0]->b_groupB)-($sum_group[1]->gtotal))*100/($fy_list1[0]->budget)),2);
												}
											
											
											
											 ?>
										</div>
									</div>
									  
								   </div>
								</div>
								</div>

						
						</div>
				</div>
				
				
				
				
				
				
				
				<div class="box-header">
					<h3 class="box-title">Enter Indent Details</h3>
				</div>
				<div class="box-body">
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="indrefno">Enter Indent Reference Number</label>
							<?php echo form_input(array('name'=>'ind_ref_no','id'=>'ind_ref_no','placeholder'=>'Indent Reference Number','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="inddate" >Indent Date</label>
							<?php echo form_input(array('name'=>'ind_date','id'=>'ind_date','placeholder'=>'Indent Date','class'=>'form-control','data-date-format'=>'dd M yyyy')) ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="supplier">Indent Type</label>
							<?php echo form_dropdown('ind_type', array(""=>"Select","n"=>"Normal","e"=>"Emergency"),"",'class="form-control"' )?>
							
						</div>
										
					</div>
					
					
					<div class="col-md-6">
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
					
					<div class="col-md-6">
						<div class="form-group">
							<label for="remarks">Remarks</label>
							<?php echo form_input(array('name'=>'ind_remarks','id'=>'ind_remarks','placeholder'=>'Indent Remarks','class'=>'form-control',)) ?>
							
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
   
  $('#ind_date').datepicker(); 
  
  
  });
  

  
 </script>

