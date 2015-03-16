	<style>
	.box-body{
	overflow-x: hidden;}
	</style>
	<div class="row" >
		<div class="col-md-12">
			<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data Table With Full Features</h3>
                                </div><!-- /.box-header -->
                                 <?php if(!empty($data)){ ?>
                                <div class="box-body table-responsive">
                               
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
												<td><?php echo ($d->hod_status == 0 ? '<span class="label label-warning">Pending</span>' :($d->hod_status == 2 ? '<span class="label label-danger">Rejected</span>' :'<span class="label label-success">Approved</span>')); ?></td>
												<td><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?=$d->admission_id ?>","<?=$d->sem_form_id ?>")'></i>
</td>
                                            </tr>
											<?php }  ?>
										</tbody>
										</table>
			</div>
            <?php } else { ?>
            <h2>There is No Semester Form to Approve!</h2>
            <?php } ?>
	</div>
	</div>
	</div>
	<script>
	function myFunction(id,fid) {
    mywindow = window.open("<?php echo base_url() ?>index.php/student_sem_form/regular_check/view/"+id+"/"+fid, "_blank", "toolbar=no, scrollbars=yes, resizable=no, top=50, left=300, width=850, height=550");
	
	}
		
		$(function() {
               
				
                $('#regStudent').dataTable();
            });
	</script>
<?php //print_r($data); ?>