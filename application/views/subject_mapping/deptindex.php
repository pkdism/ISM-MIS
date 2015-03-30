
<div class="row">
	<div class="col-sm-12">
	<?php echo form_open('subject_mapping/departmentwise') ?>
    	<div class="box box-solid box-primary">
        	<div class="box-header">
            <h4 class="box-title">Filter</h4>
            </div>
            <div class="box-body">
            <div class="row">
            	
                                
                                <div class="col-sm-4">
                                <div class="form-group">
                                		<label for="course">Select Course</label>
                               				<?php echo form_dropdown('course',array('Select Course'),'','id="course" class="form-control"') ?>
                               		 </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                		<label for="branch">Select Branch</label>
                               				<?php echo form_dropdown('branch',array('Select Branch'),'','id="branch" class="form-control"') ?>
                               		 </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                		<label for="semester">Enter Semester</label>
                               				<?php echo form_input(array('name'=>'semester','class'=>'form-control','id'=>'semester')) ?>
                               		 </div>
                                </div>
                              
                       </div>
            </div>
            <div class="box-footer">
            <?php echo form_submit('submit','Fliter','class="btn btn-primary"'); ?>
            </div>
        </div>
		<?php echo form_close(); ?>
    </div>
		<div class="col-sm-12"><br />

                                <?php if( $this->input->post('course') || $this->input->post('branch') || $this->input->post('semester')){ ?>
                                <div class="alert-info" style="padding:8px;">
                                	 <?php if($this->input->post('course'))
											echo "<span >  ".$this->sbasic_model->getCourseById($this->input->post('course'))->name."</span>";
									 ?>
                                      <?php if($this->input->post('branch'))
											echo "<span >  >>  ".$this->sbasic_model->getBranchById($this->input->post('branch'))->name."</span>";
									 ?>
                                     <?php if($this->input->post('semester'))
											echo "<span >  >>  ".$this->input->post('semester')."</span>";
									 ?>
                                </div>
                                <?php } ?>
         </div>
</div>

<?php  if(!empty($subject) && !$status) { ?>
<?php echo form_open('subject_mapping/main/mappingadd') ?>
<div class="col-sm-12">
	<div class="box box-solid box-primary">
    	<div class="box-header">
        <h3 class="box-title">Map Subject With Teacher</h3>
        </div>
        <div class="box-body">
        <div id="wait"></div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                    	<td>Sub. Id</td>
                        <td>Subject</td>
                        <td>Department</td>
                        <td>Teacher(s)</td>
                        <td>Admin</td>
                        <td>Add More</td>
                    </tr>
                </thead>
                <tbody>
                <?php
					echo form_hidden('dept',$this->session->userdata('dept_id'));
					echo form_hidden('course',$this->input->post('course'));
					echo form_hidden('branch',$this->input->post('branch'));
					echo form_hidden('semester',$this->input->post('semester'));
				
				 ?>
                <?php $i=0; foreach($subject as $s) { ?>
                	<tr id="row-<?php echo $i ?>">
                    	<td><?php echo $this->basic_model->get_subject_details($s->id)->subject_id; echo form_hidden('subId[]',$s->id); ?></td>
                        <td><?php echo $this->basic_model->get_subject_details($s->id)->name; ?></td>
                        <td><?php echo form_dropdown('department[]',array('Select Department'),'',' class="form-control dapart" onchange="setr('.$i.')" id="d-'.$i.'"') ?></td>
                        <td><?php echo form_dropdown('teacher[]',array('Select Department'),'',' class="form-control teacher" id="t-'.$i.'"') ?></td>
                        <td><select class="form-control" name="admin[]"><option value="0">No Right</option><option value="1">Right</option></select></td>
                        <td valign="middle"><center><i onclick="addRow(<?php echo $i ?>)"  style="cursor:pointer; font-size:20px; color:#74b24e;" class="glyphicon glyphicon-plus-sign add-row"></i></center></td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
        <?php echo form_submit('submit','Save','class="btn btn-primary"'); ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<?php }else if($status){ ?>

<div class="alert alert-danger alert-dismissable">
                      <i class="fa fa-ban"></i>
                                     <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <b>Alert!</b> This Semester Mapping Already Exist. Please Select diffrent Cousre,Branch,Semester for another mapping or  <a href="<?php echo site_url('subject_mapping/main/MappingView'); ?>">click here</a>  to manage existing Mapping.
                                    </div>

<?php } ?>


<script type="text/javascript">


	$(document).ready(function() {

		$.ajax({
			url : site_url("student_view_report/report_new_file_ajax/get_course_dept/<?php echo $this->session->userdata('dept_id'); ?>"),
			success : function (result) {
				$('#course').html(result);
			}});
		
		$("select[name='course']").on('change', function() {
			$.ajax({url : site_url("student_view_report/report_new_file_ajax/get_branch_bycourse/"+this.value+"/<?php echo $this->session->userdata('dept_id'); ?>"),
				success : function (result) {
					$('#branch').html(result);
				}});
	});

		$.ajax({url : site_url("student_view_report/report_new_file_ajax/get_dept"),
			success : function (result) {
				$('.dapart').html(result);
			}});

	});
	
	function setr(id){
			$('#wait').html('<i class="icon-upload icon-large"></i>');
				$.ajax({
					url:'<?php echo base_url() ?>index.php/ajax/empNameByDept/'+$('#d-'+id).val(),
					success: function(data){
							$('#wait').addClass('loading');
							$('#t-'+id).html(data);
							}
				  });
			
		//$("#employee_select").on('change',onclick_emp_nameid);
		
		}
		
	function addRow(id){
				var s=id+40;
			 tr=$('#row-'+id).clone();
			 tr.children().children('select.dapart').attr('id','d-'+s).attr('onchange','setr('+s+')');
			 tr.children().children('select.teacher').attr('id','t-'+s);
			 tr.children().children().children('.add-row').remove();
			 tr.children().children().append('&nbsp;&nbsp;<i onclick="delRow('+s+')"  style="cursor:pointer; font-size:20px; color:#d7502c;" class="glyphicon glyphicon-remove"></i>');
			 tr.attr('id','row-'+s);
			 tr.insertAfter("#row-"+id+":last");
		}
	function delRow(id){
		$('#row-'+id).remove();
		}
		
</script>