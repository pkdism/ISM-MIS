
<div clas="row">
	<div class="col-sm-12">
    	
	<?php 
		if(is_array($oldrecord[0])){
				if(in_array($this->session->userdata('semester')+1 ,$oldrecord[0])){
						$d=false;
					}else{
						$d=true;
						}
			}else{
				$d=true;
				}
	if($d){   ?>
    	<h2 class="page-header">Current Registration Form Status</h2>
       	
        
        <div class="row">
         
        <div class="col-sm-4">
        <div class="box box-solid box-success">
            	<div class="box-header">
                	<h3 class="box-title">Student Status  </h3>
                    <i class="fa fa-search pull-right"  data-toggle="tooltip" data-original-title="Click here to See the form." style="cursor:pointer; color:#fff;" onclick='myFunction("<?=$this->session->userdata('id') ?>","<?=$status[0]->sem_form_id ?>")'></i>
                </div>
                <div class="box-body">
               		 
                    <p>Form filling date: <b> <?php echo date('Y M d H:i:s',strtotime($status[0]->timestamp)); ?></b></p>
                    <p>Please contact for Admin Department for further Query !</p>
                   
                        </div>
			   
                </div>
                
               
                </div>
        <div class="col-sm-4">
        <div class="box box-solid box-warning">
            	<div class="box-header">
                	<h3 class="box-title">Status From Department Side</h3>
                </div>
                <div class="box-body">
               		 <table class="table table-bordered">
                            <tr>
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Date/Time</th>
                            </tr>
                            <tr>
                            <?php 
                            foreach($status as $s){
								$rt=($s->hod_time =='0000-00-00 00:00:00')?"--------":date('Y M d H:i:s',strtotime($s->hod_time));
								
                                echo "<td>".($s->hod_status == 0 ? '<span style="background:#FFEE75;">Pending</span>' :($s->hod_status == 2 ? '<span style="background:#FDD;">Rejected</span>' :'<span style="background:#DFD;">Approved</span>'))."</td>
                            <td>$s->hod_remark</td>	
                            <td>".$rt."</td>
                                ";	
                                
                                }
                            ?>
                            </tr>
                     </table>
                     <?php if($status[0]->hod_status ==2) {?>
               			<div class="box-footer">
                        <a class="btn btn-primary" role="button" href="<?php echo base_url(); ?>index.php/student_sem_form/regular_form/index/<?php echo $status[0]->re_id ?>">click Here to Refill the Form</a>
                        
                        </div>
			   <?php } ?>
                </div>
                </div>
        </div>
        <div class="col-sm-4">
   	 		<div class="box box-solid box-primary">
            	<div class="box-header">
                	<h3 class="box-title">Status From Acdamic Side</h3>
                </div>
                <div class="box-body">
                
               		 <table class="table table-bordered">
                            <tr>
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Date/Time</th>
                            </tr>
                            <tr>
                            <?php 
                            foreach($status as $s){
								
								$rt=($s->acdmic_time =='0000-00-00 00:00:00')?"--------":date('Y M d H:i:s',strtotime($s->hod_time));
                                echo "<td>".($s->acdmic_status == 0 ? '<span style="background:#FFEE75;">Pending</span>' :($s->acdmic_status == 2 ? '<span style="background:#FDD;">Rejected</span>' :'<span style="background:#DFD;">Approved</span>'))."</td>
                            <td>$s->acdmic_remark</td>	
                            <td>".$rt."</td>
                                ";	
                                
                                }
                            ?>
                            </tr>
                    </table>
                </div>
            </div>
        
        </div>
        
        	
        </div><?php } ?>
        <?php if(isset($oldrecord)){   ?>
        <h2 class="page-header">Semester Record</h2>
         <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs ">
                                	
										<?php
										//print_r($oldrecord);
												if($oldrecord !=0)
											foreach($oldrecord as $oldr){ ?>
										
                                    <li class="active"><a href="#sem-<?php echo $oldr['sem_form_id']; ?>" data-toggle="tab">Semester <?php  echo $oldr['semster']; ?></a></li>
                                    
                                    <?php } ?>
                                    <li class="pull-right header"><i class="fa fa-inbox"></i> Old Record</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <?php 	if($oldrecord !=0)
											foreach($oldrecord as $oldr){ ?>
                                    <div class="chart tab-pane active" id="sem-<?php echo $oldr['sem_form_id']; ?>" style="position: relative; height: 300px;">
                                    
                                    <div class="col-sm-4">
        <div class="box box-solid box-success">
            	<div class="box-header">
                	<h3 class="box-title">Student Status  </h3>
                    <i class="fa fa-search pull-right"  data-toggle="tooltip" data-original-title="Click here to See the form." style="cursor:pointer; color:#fff;" onclick='myFunction("<?=$this->session->userdata('id') ?>","<?=$oldr['sem_form_id'] ?>")'></i>
                </div>
                <div class="box-body">
               		 
                    <p>Form filling date: <b> <?php echo date('Y M d H:i:s',strtotime($status[0]->timestamp)); ?></b></p>
                    <p>Please contact for Admin Department for further Query !</p>
                   
                        </div>
			   
                </div>
                
               
                </div>
       								<div class="col-sm-4">
        <div class="box box-solid box-warning">
            	<div class="box-header">
                	<h3 class="box-title">Status From Department Side</h3>
                </div>
                <div class="box-body">
               		 <table class="table table-bordered">
                            <tr>
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Date/Time</th>
                            </tr>
                            <tr>
                            <?php 
                            foreach($status as $s){
								$rt=($s->hod_time =='0000-00-00 00:00:00')?"--------":date('Y M d H:i:s',strtotime($s->hod_time));
								
                                echo "<td>".($s->hod_status == 0 ? '<span style="background:#FFEE75;">Pending</span>' :($s->hod_status == 2 ? '<span style="background:#FDD;">Rejected</span>' :'<span style="background:#DFD;">Approved</span>'))."</td>
                            <td>$s->hod_remark</td>	
                            <td>".$rt."</td>
                                ";	
                                
                                }
                            ?>
                            </tr>
                     </table>
                     <?php if($status[0]->hod_status ==2) {?>
               			<div class="box-footer">
                        <a class="btn btn-primary" role="button" href="<?php echo base_url(); ?>index.php/student_sem_form/regular_form/index/<?php echo $status[0]->re_id ?>">click Here to Refill the Form</a>
                        
                        </div>
			   <?php } ?>
                </div>
                </div>
        </div>
        							<div class="col-sm-4">
   	 		<div class="box box-solid box-primary">
            	<div class="box-header">
                	<h3 class="box-title">Status From Acdamic Side</h3>
                </div>
                <div class="box-body">
                
               		 <table class="table table-bordered">
                            <tr>
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Date/Time</th>
                            </tr>
                            <tr>
                            <?php 
                            foreach($status as $s){
								
								$rt=($s->acdmic_time =='0000-00-00 00:00:00')?"--------":date('Y M d H:i:s',strtotime($s->hod_time));
                                echo "<td>".($s->acdmic_status == 0 ? '<span style="background:#FFEE75;">Pending</span>' :($s->acdmic_status == 2 ? '<span style="background:#FDD;">Rejected</span>' :'<span style="background:#DFD;">Approved</span>'))."</td>
                            <td>$s->acdmic_remark</td>	
                            <td>".$rt."</td>
                                ";	
                                
                                }
                            ?>
                            </tr>
                    </table>
                </div>
            </div>
        
        </div>
                                    </div>
                                   <?php } ?>
                                </div>
                            </div><!-- /.nav-tabs-custom -->
        
        <?php } ?>
        
    </div>
	 
</div>
<script>
	function myFunction(id,fid) {
    mywindow = window.open("<?php echo base_url() ?>index.php/student_sem_form/regular_form/view/"+id+"/"+fid, "_blank", "toolbar=no, scrollbars=yes, resizable=no, top=50, left=300, width=850, height=550");
	
	}
	</script>
<?php // print_r($status);?>

