<?php // print_r( $this->session->all_userdata()); ?>
<div class="row">
<div class="col-sm-12">
	<div class="box box-solid box-primary">
    	<div class="box-header">
        	<h3 class="box-title">View Mapping</h3>
        </div>
    	<div class="box-body">
        	<div class="row">
            <div class="col-sm-12">
            	
            </div>
            <div class="col-sm-12">
            	<?php if($map) { ?>
            		<table class="table table-hover table-bordered">
                    	<thead>
                        	<tr>
                            	<td>S.No</td>
                                <td>Department</td>
                                <td>Course</td>
                                 <td>Branch</td>
                                <td>Semester</td>
                                <td>Year</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php $i=1; foreach($map as $m){ ?>
                        	<tr id="m-<?php echo $m->map_id; ?>">
                            	<td><?php echo $i; ?></td>
                                <td><?php echo $this->sbasic_model->getDepatmentById($m->dept_id)->name ?></td>
                                <td><?php echo $this->sbasic_model->getCourseById($m->course_id)->name ?></td>
                                <td><?php echo $this->sbasic_model->getBranchById($m->branch_id)->name ?></td>
                                <td><?php echo $m->semester ?></td>
                                <td><?php echo $m->date; ?></td>
                                <td align="center"><span style="font-size:15px;"><i onclick="mapView('<?php echo $m->map_id;?>','<?php echo $m->dept_id ?>','<?php echo $m->course_id ?>','<?php echo $m->branch_id ?>','<?php echo $m->semester ?>')" style="color:#0978b8; cursor:pointer;" class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;&nbsp;
                              <?php  $a = $this->session->userdata('auth'); ?>
           <?php if(array_search('deo',$a) || $a[0]=='deo'){ ?>   
                                <i onclick="mapEdit('<?php echo $m->map_id;?>')" style="color:#048a6c; cursor:pointer;" class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;&nbsp;<i onclick="mapDel('<?php echo $m->map_id;?>','<?php echo $m->dept_id ?>')" style="color:#e7560e; cursor:pointer;" class="glyphicon glyphicon-remove"></i>
		
		<?php }else if((array_search('hod',$a) || $a[0]==='hod') && $this->session->userdata('dept_id') ===  $m->dept_id ){ ?>
                       
                        <i onclick="mapEdit('<?php echo $m->map_id;?>')" style="color:#048a6c; cursor:pointer;" class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;&nbsp;<i onclick="mapDel('<?php echo $m->map_id;?>','<?php echo $m->dept_id ?>')" style="color:#e7560e; cursor:pointer;" class="glyphicon glyphicon-remove"></i>
                       
             <?php }else if((array_search('tti',$a) || $a[0]=='tti') && $this->session->userdata('dept_id') ==  $m->dept_id ){ ?>
                       
                        <i onclick="mapEdit('<?php echo $m->map_id;?>')" style="color:#048a6c; cursor:pointer;" class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;&nbsp;<i onclick="mapDel('<?php echo $m->map_id;?>','<?php echo $m->dept_id ?>')" style="color:#e7560e; cursor:pointer;" class="glyphicon glyphicon-remove"></i>
                       
                        <?php } ?>
                                </span></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <?php }else { ?>
                    
                    <br/>
               	<div class="alert alert-warning alert-dismissable">
                                        <i class="fa fa-info"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <b>There is No Suject Mapping!</b> Please make Subject Mapping .
                                    </div>
               <?php } ?>
            </div>
        	</div>
        </div>
        <div class="box-footer"></div>
    
    </div>

</div>
</div>
<div class="modal fade" table-index="-1" role="dialog" aria-hideen="true" id="viewport">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hideen="true">x</button>
				<h4 id="Modal-Label"></h4>
			</div>
			<div class="modal-body">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs" id="navsub">
					</ul>
				</div>
			
			</div>
			<div class="modal-footer"></div>
			
		</div>
	</div>	
</div>
<style>.modal .modal-body {
    max-height: 500px;
   
    overflow-y: auto;
}
.modal-dialog{
	width:60%;
}
</style>
<script type="text/javascript">
	$(function(){
			$('.table').dataTable();

		});

	function mapView(id,dept,course,branch,semester){
		$('.modal-body').html('<div class="nav-tabs-custom"><ul class="nav nav-tabs" id="navsub"><li class="active"><a data-toggle="tab" href="#tab_ALL" aria-expanded="true">ALL Subjects</a></li></ul></div><div class="tab-content"><div id="tab_ALL" class="tab-pane active"><div class="col-sm-12"><div class="table-responsive"><table id="all_sub" class="table table-hovered  table-bordered"><thead><tr><th>Id</th><th>Subject Name</th><th>L</th><th>T</th><th>P</th><th>Cr.Hr.</th><th>Co.Hr.</th><th>Teacher</th><th>Dept</th></tr></thead><tbody></tbody></table></div></div></div><br></div>');
		$('#Modal-Label').html('<b>View Subject Details </b>   '+dept+' >> '+course+' >> '+branch+' >> '+semester );
					$.ajax({
								url:site_url('subject_mapping/main/AjaxView'),
								data:{'id':id},
								type:'POST',
								success:function(data){
									//	alert(data);
									var obj = jQuery.parseJSON(data);
									
									var i=-1;
									$.each( obj, function( key, value ) {
										if(i == -1){
											$('#navsub').append('<li class=""><a data-toggle="tab" href="#tab_'+value.subjectId+'" aria-expanded="false">'+value.subjectName+'</a></li>');
										}	else{				
										if(obj[i].subjectName == value.subjectName){
												}else{
										$('#navsub').append('<li class=""><a data-toggle="tab" href="#tab_'+value.subjectId+'" aria-expanded="false">'+value.subjectName+'</a></li>');
												}
										}
										
										i++;
										});
									
									
									 var i=-1;
									$.each( obj, function( key, value ) {
										if(i == -1){
											$('.tab-content').append('<div id="tab_'+value.subjectId+'" class="tab-pane"><div class="col-sm-12"><div class="box box-primary box-solid"><div class="box-header"><h3 class="box-title">'+value.firstname+' '+value.middlename+' '+value.lastname+'</h3></div><div class="box-body"><h4 class="page-heading">Teacher Details</h4><div class="row"><div class="col-sm-8"><div class="col-sm-12"><b>Name :</b> '+value.firstname+' '+value.middlename+' '+value.lastname+'</div><div class="col-sm-12"><b>Designation:</b> '+value.designation+'</div><div class="col-sm-12"><b>Email Address:</b> '+value.email+'</div><div class="col-sm-12"><b>Office Phone:</b> '+value.officeNo+'</div><div class="col-sm-12"><b>Research Interest:</b> '+value.researchInterest+'</div><div class="col-sm-12"><b>Department:</b> '+value.dept+'</div></div><div class="col-sm-4"><img src="<?php echo base_url() ?>assets/images/'+value.photo+'" width="150" /></div></div><h4 class="page-heading">Subject Details</h4><div class="col-sm-12"><div class="table-responsive"><table class="table table-hovered  table-bordered"><thead><tr><th>Id</th><th>Subject Name</th><th>L</th><th>T</th><th>P</th><th>Cr.Hr.</th><th>Co.Hr.</th><th>Elective</th><th>Type</th></tr></thead><tbody><tr><td>'+value.subjectId+'</td><td>'+value.subjectName+'</td><td>'+value.lecture+'</td><td>'+value.tutorial+'</td><td>'+value.practical+'</td><td>'+value.creditHr+'</td><td>'+value.contactHr+'</td><td>'+value.elective+'</td><td>'+value.type+'</td></tr></tbody></table></div></div></div></div></div><div style="clear: both;"></div></div>');
											

											}else{

												if(obj[i].subjectId == value.subjectId){

													$('#tab_'+value.subjectId).append('<div class="col-sm-12"><div class="box box-primary box-solid"><div class="box-header"><h3 class="box-title">'+value.firstname+' '+value.middlename+' '+value.lastname+'</h3></div><div class="box-body"><h4 class="page-heading">Teacher Details</h4><div class="row"><div class="col-sm-8"><div class="col-sm-12"><b>Name :</b> '+value.firstname+' '+value.middlename+' '+value.lastname+'</div><div class="col-sm-12"><b>Designation:</b> '+value.designation+'</div><div class="col-sm-12"><b>Email Address:</b> '+value.email+'</div><div class="col-sm-12"><b>Office Phone:</b> '+value.officeNo+'</div><div class="col-sm-12"><b>Research Interest:</b> '+value.researchInterest+'</div><div class="col-sm-12"><b>Department:</b> '+value.dept+'</div></div><div class="col-sm-4"><img src="<?php echo base_url() ?>assets/images/'+value.photo+'" width="150"/></div></div><h4 class="page-heading">Subject Details</h4><div class="row"><div class="col-sm-12"><div class="table-responsive"><table class="table table-hovered  table-bordered"><thead><tr><th>Id</th><th>Subject Name</th><th>L</th><th>T</th><th>P</th><th>Cr.Hrs.</th><th>Con.Hrs.</th><th>Elective</th><th>Type</th></tr></thead><tbody><tr><td>'+value.subjectId+'</td><td>'+value.subjectName+'</td><td>'+value.lecture+'</td><td>'+value.tutorial+'</td><td>'+value.practical+'</td><td>'+value.creditHr+'</td><td>'+value.contactHr+'</td><td>'+value.elective+'</td><td>'+value.type+'</td></tr></tbody></table></div></div></div></div></div></div><div style="clear:both;"></div>');
													
													}else{

														$('.tab-content').append('<div id="tab_'+value.subjectId+'" class="tab-pane"><div class="col-sm-12"><div class="box box-primary box-solid"><div class="box-header"><h3 class="box-title">'+value.firstname+' '+value.middlename+' '+value.lastname+'</h3></div><div class="box-body"><h4 class="page-heading">Teacher Details</h4><div class="row"><div class="col-sm-8"><div class="col-sm-12"><b>Name :</b> '+value.firstname+' '+value.middlename+' '+value.lastname+'</div><div class="col-sm-12"><b>Designation:</b> '+value.designation+'</div><div class="col-sm-12"><b>Email Address:</b> '+value.email+'</div><div class="col-sm-12"><b>Office Phone:</b> '+value.officeNo+'</div><div class="col-sm-12"><b>Research Interest:</b> '+value.researchInterest+'</div><div class="col-sm-12"><b>Department:</b> '+value.dept+'</div></div><div class="col-sm-4"><img src="<?php echo base_url() ?>assets/images/'+value.photo+'" width="150" /></div></div><h4 class="page-heading">Subject Details</h4><div class="col-sm-12"><div class="table-responsive"><table class="table table-hovered  table-bordered"><thead><tr><th>Id</th><th>Subject Name</th><th>L</th><th>T</th><th>P</th><th>Cr.Hrs.</th><th>Con.Hrs.</th><th>Elective</th><th>Type</th></tr></thead><tbody><tr><td>'+value.subjectId+'</td><td>'+value.subjectName+'</td><td>'+value.lecture+'</td><td>'+value.tutorial+'</td><td>'+value.practical+'</td><td>'+value.creditHr+'</td><td>'+value.contactHr+'</td><td>'+value.elective+'</td><td>'+value.type+'</td></tr></tbody></table></div></div></div></div></div><div style="clear: both;"></div></div>');


														}
												
												}
$('#all_sub tbody').append('<tr><td>'+value.subjectId+'</td><td>'+value.subjectName+'</td><td>'+value.lecture+'</td><td>'+value.tutorial+'</td><td>'+value.practical+'</td><td>'+value.creditHr+'</td><td>'+value.contactHr+'</td><td>'+value.firstname+' '+value.middlename+' '+value.lastname+'</td><td>'+value.dept+'</td></tr>');

										i++;
										
										});
									
									 
									
									$('#viewport').modal({ keyboard: false, backdrop:'static' });

									}
								
						});
				
		}
<?php if(array_search('deo',$a) || $a[0]=='deo' || array_search('hod',$a) || $a[0]=='hod' || array_search('tti',$a) || $a[0]=='tti') { ?>
	function mapDel(id,dept){

				if(confirm("Are you Sure You Want to Delete this Semester Mapping!")){

							$.ajax({
									url:site_url('subject_mapping/main/AjaxDelete'),
									data:{'id':id,'dept':dept},
									type:'POST',
									success:function(data){

											if(data == "1"){
													$('#m-'+id).remove();
												}else{
													alert(data);
													}

										}	
												
							});	
					}
		}
	function mapEdit(id){
				window.location= "<?php echo base_url() ?>index.php/subject_mapping/main/mappingEdit/"+id;	
		}
	<?php } ?>
</script>