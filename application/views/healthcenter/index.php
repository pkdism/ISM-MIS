<?php echo form_open_multipart('healthcenter/add_finyear'); ?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Financial Year</h3>
				</div>
				<div class="box-body">
				<div class="col-lg-4 col-centered"></div>
				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label for="admissionNo">Enter Financial Year</label>
							<?php echo form_input(array('name'=>'finyear','id'=>'finyear','placeholder'=>'like 2011-12','class'=>'form-control',)) ?>
						</div>
						<div class="form-group">
							<label for="admissionNo">Enter Budget</label>
							<?php echo form_input(array('name'=>'budget','id'=>'budget','placeholder'=>'Enter Budget','class'=>'form-control',)) ?>
						</div>
						<div class="box-footer">
				<?php  echo form_submit('submit','Submit','class="btn btn-primary"'); ?>
				</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	
	
	
	</div>
</div>




