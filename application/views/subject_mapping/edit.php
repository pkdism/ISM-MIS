
<?php
	//print_r($map);
	//print_r($map_des);
?>


<div class="row">
<div class="col-sm-12">
<ol class="breadcrumb">
<?php foreach($map as $m) { ?>
  <li><?php echo $this->sbasic_model->getDepatmentById($m['dept_id'])->name ?></li>
  <li><?php echo $this->sbasic_model->getCourseById($m['course_id'])->name ?></li>
  <li><?php echo $this->sbasic_model->getBranchById($m['branch_id'])->name ?></li>
  <li class="active"><?php echo $m['semester']?></li>
<?php }	?>
  </ol>
</div>
<?php echo form_open('')?>
<div class="col-sm-12">
	<div class="box box-solid box-primary">
			<div class="box-header">
				<h3 class="box-title">Edit Subject Mapping</h3>
					<div class="box-tools pull-right">
				<a href="#" class="btn btn-success" id="AddTea" style="color:#fff;"><i class="fa fa-plus"></i> Add New Teacher</a>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
						<table id="table_action" class="table table-bordered table-hovered">
							<thead>
								<tr>
			
									<th>Subject Code</th>
									<th>Subject Name</th>
									<th>Deparment</th>
									<th>Teacher</th>
									<th>Rights</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
								
								<?php foreach($map_des as $md){?>
								<tr id="row-<?php echo $md['subject_id'] ?>-<?php echo $md['teacher_id']  ?>">
									<td><?php echo $this->basic_model->get_subject_details($md['subject_id'])->subject_id; echo form_hidden('subId[]',$md['subject_id']); ?></td>
									<td><?php echo $this->basic_model->get_subject_details($md['subject_id'])->name; ?></td>
									<td><?php echo $this->sbasic_model->getDepatmentById($this->user_details_model->user_details_model->getUserById($md['teacher_id'])->dept_id)->name; ?></td>
									<td id="tea-<?php echo $md['subject_id'] ?>-<?php echo $md['teacher_id']  ?>"><?php echo $this->user_details_model->user_details_model->getUserById($md['teacher_id'])->first_name." ".$this->user_details_model->user_details_model->getUserById($md['teacher_id'])->middle_name." ".$this->user_details_model->user_details_model->getUserById($md['teacher_id'])->last_name; ?></td>
									<td  id="rig-<?php echo $md['subject_id'] ?>-<?php echo $md['teacher_id']  ?>"><?php echo ($md['rights'] == 1)?"Yes":"No"; ?></td>
									<td><i onclick="mapEdit('<?php echo $map[0]['map_id']?>','<?php echo $md['subject_id'] ?>','<?php echo $md['teacher_id'] ?>','<?php echo $this->basic_model->get_subject_details($md['subject_id'])->name; ?>')" style="color:#048a6c; cursor:pointer;" class="glyphicon glyphicon-edit"></i>
									<?php if($md['M'] == 0){ ?>
									&nbsp;&nbsp;&nbsp;<i onclick="mapDel('<?php echo $map[0]['map_id']?>','<?php echo $md['subject_id'] ?>','<?php echo $md['teacher_id'] ?>')" style="color:#e7560e; cursor:pointer;" class="glyphicon glyphicon-remove"></i><?php } ?></td>
									
								</tr>
								<?php } ?>
							</tbody>
						</table>
				</div>
			</div>
			<div class="box-footer">
			
			</div>
			
	</div>
</div>
<?php echo form_close(); ?>
</div>
<div class="modal fade" table-index="-1" role="dialog" aria-hideen="true" id="viewport">
	<div class="modal-dialog">
		<?php echo form_open('subject_mapping/main/mappingDesEdit',array('id'=>'form-edit')); ?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hideen="true">x</button>
				<h4 id="Modal-Label"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
            	
                                <div class="col-sm-12">
                               		<div class="form-group">
                                		<label for="department">Department</label>
                               				<?php echo form_dropdown('department_name',array('Select Department'),'','id="department_name" class="form-control dapart"') ?>
                               		 </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="form-group">
                                		<label for="course">Select Teacher</label>
                               				<?php echo form_dropdown('teacher',array('Select Teacher'),'','id="teacher" class="form-control"') ?>
                               		 </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="form-group">
                                		<label for="course">Is Co-ordinator</label>
                               				<?php echo form_dropdown('cod',array('Select Course','Y'=>"Yes He/She is Co-ordinator",'N'=>"No He/She is not Co-ordinator"),'','id="cod" class="form-control"') ?>
                               		 </div>
                                </div>
                                
                                
                                
                
             </div>
			
			</div>
			<div class="modal-footer">
			<?php echo form_hidden('mid',''); ?>
			<?php echo form_hidden('subid',''); ?>
			<?php echo form_hidden('oldt',''); ?>
			<?php echo form_submit('edit','Edit','class="btn btn-primary"')?>
			</div>
			
		</div>
		<?php echo form_close(); ?>
	</div>	
</div>

<div class="modal fade" table-index="-1" role="dialog" aria-hideen="true" id="Add">
	<div class="modal-dialog">
		<?php echo form_open('subject_mapping/main/mappingDesAdd',array('id'=>'form-add')); ?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hideen="true">x</button>
				<h4 id="aModal-Label"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
			            	 <div class="col-sm-12">
			                  	 <div class="form-group">
			                  	 <?php  foreach($map_des as $md){
			                  	 		if($md['M'] == 1){
			                  	 	$sub[$md['subject_id']] = $this->basic_model->get_subject_details($md['subject_id'])->name;}
			                  	 	$mid = $md['map_id'];
			                  	 }?>
			                                		<label for="department">Select Subject(s)</label>
			                               				<?php echo form_dropdown('subject_name',$sub,'','id="asubject_name" class="form-control subject"') ?>
			                   </div>
			                  </div>
                                <div class="col-sm-12">
                               		<div class="form-group">
                                		<label for="department">Department</label>
                               				<?php echo form_dropdown('adepartment_name',array('Select Department'),'','id="adepartment_name" class="form-control dapart"') ?>
                               		 </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="form-group">
                                		<label for="course">Select Teacher</label>
                               				<?php echo form_dropdown('teacher',array('Select Teacher'),'','id="ateacher" class="form-control"') ?>
                               		 </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="form-group">
                                		<label for="course">Is Co-ordinator</label>
                               				<?php echo form_dropdown('cod',array('Select Course','1'=>"Yes He/She is Co-ordinator",'0'=>"No He/She is not Co-ordinator"),'','id="acod" class="form-control"') ?>
                               		 </div>
                                </div>
                                
                                
                                
                
             </div>
			
			</div>
			<div class="modal-footer">
			<?php echo form_hidden('amid',$mid); ?>
			<?php echo form_submit('save','Save','class="btn btn-primary"')?>
			</div>
			
		</div>
		<?php echo form_close(); ?>
	</div>	
</div>

<script type="text/javascript">

$(document).ready(function() {
	$.ajax({url : site_url("student_view_report/report_new_file_ajax/get_dept"),
			success : function (result) {
				$('.dapart').html(result);
			}});

	$('#department_name, #adepartment_name').on('change',function(){
		$.ajax({
			url:'<?php echo base_url() ?>index.php/ajax/empNameByDept/'+$(this).val(),
			success: function(data){
					$('#teacher, #ateacher').html(data);
					}
		  });

		 
	});

	$('#form-edit').on('submit', function(){

				$.ajax({
						url:site_url('subject_mapping/main/mappingDesEdit'),
						type:'POST',
						data:{'mapId':$('input[name=mid]').val(),'subId':$('input[name=subid]').val(),'oldt':$('input[name=oldt]').val(),'teacherId':$('#teacher').val(),'cod':$('#cod').val()},
						success:function(data){
									if(data != '0'){
										//alert(data);	
										json = $.parseJSON(data);
								$('#tea-'+$('input[name=subid]').val()+'-'+$('input[name=oldt]').val()).html(json.name);	
								$('#rig-'+$('input[name=subid]').val()+'-'+$('input[name=oldt]').val()).html(json.rights);	
																	
										$('#viewport').modal('hide');
										
										}
													
							}
					});
					return false;
		});

	$('#AddTea').on('click',function(){
		$('#aModal-Label').html('Add Subject Mapping');
				$('#Add').modal({ keyboard: false, backdrop:'static' });
		});

	$('#form-add').on('submit',function(){
				
				$.ajax({
						url:site_url('subject_mapping/main/mappingDesAdd'),
						type:'POST',
						data:{'amid':$('input[name=amid]').val(),'subId':$('#asubject_name').val(),'teacher':$('#ateacher').val(),'cod':$('#acod').val()},
						success: function(data){
									if(data == '1'){
									window.location=site_url('subject_mapping/main/mappingEdit/'+$('input[name=amid]').val());
										}
							}
					});
				return false;
		});

});

function mapDel(mid,subid,teacher){
	
	$.ajax({
		url:site_url('subject_mapping/main/mapDesDel'),
		type:'POST',
		data:{'mid':mid,'sid':subid,'tid':teacher},
		success: function(data){
					if(data == '1'){
						$('#row-'+subid+'-'+teacher).remove();
						}
			}
	});

}

function mapEdit(mapId,subId,teacherId,subName){
	$('#Modal-Label').html('Edit Subject : '+subName);
	$('input[name=mid]').val(mapId);
	$('input[name=subid]').val(subId);
	$('input[name=oldt]').val(teacherId);
	$('#viewport').modal({ keyboard: false, backdrop:'static' });
// 		$.ajax({
// 				url:site_url(''),
// 			});
}
</script>
