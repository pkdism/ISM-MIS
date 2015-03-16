	<style>
	.box-body{overflow-x: hidden;}
	</style>
	<div class="row" >
		<div class="col-md-12">
			<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Filter to Search</h3>
                                </div><!-- /.box-header -->
                               
                                
                                 <div class="box-body table-responsive">
                                 <?php  echo form_open('student_sem_form/regular_check_acdamic'); ?>
                                <div class="row">
                                <div class="col-sm-3">
                               		<div clss="form-group">
                                		<label for="department">Department</label>
                               				<?php echo form_dropdown('department',array('Select Department'),'','id="department_name" class="form-control"') ?>
                               		 </div>
                                </div>
                                <div class="col-sm-3">
                                <div clss="form-group">
                                		<label for="course">Select Course</label>
                               				<?php echo form_dropdown('course',array('Select Course'),'','id="course" class="form-control"') ?>
                               		 </div>
                                </div>
                                <div class="col-sm-3">
                                <div clss="form-group">
                                		<label for="branch">Select Branch</label>
                               				<?php echo form_dropdown('branch',array('Select Branch'),'','id="branch" class="form-control"') ?>
                               		 </div>
                                </div>
                                <div class="col-sm-3">
                                <div clss="form-group">
                                		<label for="semester">Enter Semester</label>
                               				<?php echo form_input(array('name'=>'semester','class'=>'form-control','id'=>'semester')) ?>
                               		 </div>
                                </div>
                                <div class="col-sm-2"><br />
                                	<div clss="form-group">
                                   
                                		<?php echo form_submit('submit','Fliter','class="btn btn-primary"'); ?>									 </div><br />
                                </div>
                                <div class="col-sm-10"><br />

                                <?php if($this->input->post('department') || $this->input->post('course') || $this->input->post('branch') || $this->input->post('semester')){ ?>
                                <div class="alert-info" style="padding:8px;">
                                	<?php if($this->input->post('department'))
											echo "<span >".$this->sbasic_model->getDepatmentById($this->input->post('department'))->name."</span>";
									 ?>
                                     <?php if($this->input->post('course'))
											echo "<span >&nbsp;&nbsp; >> &nbsp;&nbsp;".$this->sbasic_model->getCourseById($this->input->post('course'))->name."</span>";
									 ?>
                                      <?php if($this->input->post('branch'))
											echo "<span >&nbsp;&nbsp; >>&nbsp;&nasp; ".$this->sbasic_model->getBranchById($this->input->post('branch'))->name."</span>";
									 ?>
                                     <?php if($this->input->post('semester'))
											echo "<span >&nbsp;&nasp; >> &nbsp;&nasp;".$this->input->post('semester')."</span>";
									 ?>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php echo form_close(); ?>
                                 <div class="row">
                                                              
                                <div class="col-sm-12">
                                 <?php if(!empty($data)){ ?>
                                   <table id="regStudent" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Ad No.</th>
                                                <th>Name of Student</th>
                                                <th>Course</th>
                                                <th>Branch</th>
                                                <th>Semester</th>
												<th>Status</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
											<?php foreach($data as $d) { ?>
										<tr>
                                                <td><?=$d->admission_id ?></td>
                                                <td><?=$d->first_name." ".$d->middle_name." ".$d->last_name; ?></td>
                          <td><?php echo $this->sbasic_model->getCourseById($d->course_id)->name; ?></td>
                                                <td><?php echo $this->sbasic_model->getBranchById($d->branch_id)->name; ?></td>
                                                <td><?=$d->semster ?></td>
												<td><?php echo ($d->acdmic_status == 0 ? '<span class="label label-warning">Pending</span>' :($d->acdmic_status == 2 ? '<span class="label label-danger">Rejected</span>' :'<span class="label label-success">Approved</span>')); ?></td>
												<td><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?=$d->admission_id ?>","<?=$d->sem_form_id ?>")'></i>
</td>
                                            </tr>
											<?php }  ?>
										</tbody>
										</table>
			
            <?php } else { ?>
            <h3 class="page-header">There is No Semester Form to Approve!</h3>
            <?php } ?>
            </div>
            </div>
            </div>
	</div>
	</div>
	</div>
	<script>
	function myFunction(id,fid) {
    mywindow = window.open("<?php echo base_url() ?>index.php/student_sem_form/regular_check_acdamic/view/"+id+"/"+fid, "_blank", "toolbar=no, scrollbars=yes, resizable=no, top=50, left=300, width=850, height=550");
	
	}
		
		$(function() {
                $('#regStudent').dataTable();
            });
	</script>
<?php //print_r($data); ?>