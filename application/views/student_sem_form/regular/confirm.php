<?php //print_r($result); ?>
<style>
    .hcolor{background-color:#2E4D59; color:#fff; font-weight:bold; text-align:center;}
    </style>


<div class="row">
	<div class="col-md-12">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
		<!-- Basic Details Section-->
			<div class="box box-primary">
				<div class="box-header">
				<h3 class="box-title">General Student Details</h3>
				</div>
				<div class="box-body">
				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label for="admissionNo">Admission No.</label>
							<?php echo form_input(array('name'=>'admissionNo','id'=>'admissionNo','value'=>$this->session->userdata('id'),'disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="studentName">Student Name</label>
							<?php echo form_input(array('name'=>'studentName','id'=>'studentName','value'=>$this->session->userdata('name'),'disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="studentName">Name of Course</label>
							<?php echo form_input(array('name'=>'nameofCourse','id'=>'nameofCourse','value'=>$this->sbasic_model->getCourseById($this->session->userdata('course_id'))->name,'disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="studentName">Name of Branch</label>
							<?php echo form_input(array('name'=>'nameofBranch','id'=>'nameofCourse','value'=>$this->sbasic_model->getBranchById($this->session->userdata('branch_id'))->name,'disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="studentName">Semester Registering for</label>
							<?php echo form_input(array('name'=>'semester','id'=>'semester','value'=>($this->session->userdata('semester')+1),'disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
						<?php $session = (($this->session->userdata('semester')+1)%2 == 0)?'Winter':'Monsoon'  ?>
					<div class="col-md-2">
						<div class="form-group">
							<label for="studentName">Session</label>
							<?php echo form_input(array('name'=>'session','id'=>'session','value'=>$session,'disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
				</div>	
				</div>
			</div>
			<!-- GPA & Result Section-->
			<div class="box box-warning">
				<div class="box-header">
				<h3 class="box-title">GPA & Results of all Previous Semester</h3>
			</div>
				<div class="box-body">
				
				<div class="row">
					<?php for($p=1; $p<=(int)$this->session->userdata('semester'); $p++){
						$q=$this->get_results->getGPAperSemester($this->session->userdata('id'),$p);
						?>
					<div class="col-md-1">
						<div class="form-group has-success">
							<center><label for="studentName"><?php echo $p ?></label></center>
							<?php echo form_input(array('name'=>'session','id'=>"sem_".$p,'value'=>$q,'disabled'=>'disabled','class'=>'form-control',)); ?>
						</div>
					</div>
					<?php } ?>
						</div>
                        <h5>Note: Red box means <span class="label label-danger">FAIL</span> and Green Box means <span class="label label-success">PASS</span></h5>
					</div>
					
					
					
				</div>	
				</div>
			</div>
			<!-- Core Subject Section-->
			<div class="box box-primary">
				<div class="box-header">
				<h3 class="box-title">Subject Register for Current Semester</h3>
				</div>
				<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover" >
							<thead>
							<tr>
							<th>Serial Number</th>
							<th>Subject Code</th>
							<th>Subject Name</th>
							</tr>
							</thead>
							<tbody>
								  <?php foreach($subjects as $subject){?> 
    						  <tr>
       						 <td data-field="subjectseq" ><?php echo $subject['sequence']; ?></td>
        					<td data-field="SubjectCode" ><?php echo $subject['subject_id']; ?></td>
       						 <td data-field="subjectName"><?php echo $subject['name']; ?></td>
      						</tr>
                            <?php } ?>
							</tbody>
						</table>							
					</div>
				</div>	
				</div>
			</div>
			<!-- Elective Subject Section-->
			<?php if(!empty($ele)){ ?>
			<div class="box box-primary">
				<div class="box-header">
				<h3 class="box-title">Elective Subject Register for Current Semester</h3>
				</div>
				<div class="box-body">
				<div class="row">
				<div class="col-md-12">
						<table class="table table-hover" >
							<thead>
							<tr>
                            <th>Serial Number</th>
							<th>Subject Code</th>
							<th>Subject Name</th>
							</tr>
							</thead>
							<tbody>
								
                                <!-- Elective -->
                                 <?php  foreach($ele as $e){?> 
                                  <tr>
                                    <td data-field="subjectseq"><?php echo $e['sub_seq']; ?></td>
                                      <td data-field="subjectseq"><?php echo $e['subject_id']; ?></td>
                                    <td data-field="subjectseq"><?php echo $e['name']; ?></td>
                                  </tr>
                                  <?php } ?>
                                
							</tbody>
						</table>							
					</div>
				</div>	
				</div>
			</div>
			<?php } ?>
			<!-- Honour minor Subject Section-->
			<?php if(!empty($HM)){ ?>
			<div class="box box-primary">
				<div class="box-header">
				<h3 class="box-title">Elective Subject Register for Current Semester</h3>
				</div>
				<div class="box-body">
				<div class="row">
				<div class="col-md-12">
						<table class="table table-hover" >
							<thead>
							<tr>
                            <th>Serial Number</th>
							<th>Subject Code</th>
							<th>Subject Name</th>
							</tr>
							</thead>
							<tbody>
								
                                <!-- Elective -->
                                 <?php $i=1; foreach($HM as $e){?> 
                                  <tr>
                                    <td data-field="subjectseq"><?php echo $i; ?></td>
                                      <td data-field="subjectseq"><?php echo $e['subject_id']; ?></td>
                                    <td data-field="subjectseq"><?php echo $e['name']; ?></td>
                                  </tr>
                                  <?php $i++; } ?>
                                
							</tbody>
						</table>							
					</div>
				</div>	
				</div>
			</div>
			<?php } ?>
             <!-- Carry Over -->
            <? if(is_array($carryover)){?>
            <div class="box box-warning">
            <div class="box-header">
            <h2 class="box-title">Carryover Subject(s) & Fee Details</h2>
            </div>
            <div class="box-body">
            	<table class="table table-hover">
                	<thead>
							<tr>
                            <th>Semester</th>
							<th>Subject One Code</th>
							<th>Subject One Name</th>
                            <th>Subject Two Code</th>
							<th>Subject Two Name</th>
							</tr>
							</thead>
                      <tbody>
                      <?php foreach($carryover as $c) { ?>
                      <tr>
                      <td><?php echo $c['semester'] ?></td>
                      <?php if($c['subject1_id']) { ?>
                      <td><?php echo $this->get_subject->getSubjectById($c['subject1_id'])->subject_id ?></td>
                      <td><?php echo $this->get_subject->getSubjectById($c['subject1_id'])->name  ?></td>
                        <?php } else {?>
                      <td></td>
                      <td></td>
                      <?php } ?>
					  <?php if($c['subject2_id']) { ?>
                      <td><?php echo $this->get_subject->getSubjectById($c['subject2_id'])->subject_id ?></td>
                      <td><?php echo $this->get_subject->getSubjectById($c['subject2_id'])->name  ?></td>
                      <?php } else {?>
                      <td></td>
                      <td></td>
                      <?php } ?>
                      </tr>
                      <?php } ?>
                      
                      </tbody>
                </table>
                <h4 class="page-heading">Carry Over Fee Details</h4>
                <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                	<label>Date of Payment</label>
                    <input type="text" disabled="disabled" class="form-control" value="<?php echo $carryover[0]['fee_date'] ?>" />
                </div>
                <div class="form-group">
                	<label>Amount Paid</label>
                    <input type="text" disabled="disabled" class="form-control" value="<?php echo $carryover[0]['fee_amt'] ?>" />
                </div>
                <div class="form-group">
                	<label>Transaction id / Reference No.</label>
                    <input type="text" disabled="disabled" class="form-control" value="<?php echo $carryover[0]['trans_id'] ?>" />
                </div>
                </div>
                <div class="col-sm-6">
               		<img src="<?php echo base_url(); ?>assets/images/semester_reg/sem_slip/<?php echo $carryover[0]['fee_slip'] ?>" alt="Pay Slip of Carry Over" />
                </div>
                </div>
            </div>
            
            </div>
            <? } ?>
            
			<!-- Fee Slip Upload -->
			<div class="box box-primary">
				<div class="box-header">
				<h3 class="box-title">Pay Slip Details</h3>
				</div>
				<div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="subjectName">Date of Payment</label>
							<?php echo form_input(array('name'=>'dateofPayment','id'=>'dateofPayment','value'=>$this->input->post('dateofPayment'),'placeholder'=>'Enter Date','class'=>'form-control',)) ?>
						</div>
						<div class="form-group">
						<label for="subjectName">Amount Paid</label>
							<?php echo form_input(array('name'=>'amount','id'=>'amount','value'=>$this->input->post('amount'),'placeholder'=>'Amount','class'=>'form-control',)) ?>
						</div>
						<div class="form-group">
						<label for="subjectName">Transaction id / Reference No.</label>
							<?php echo form_input(array('name'=>'transId','id'=>'transId','value'=>$this->input->post('transId'),'placeholder'=>'Transaction Id','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
					
					<img width="200" src="<?php echo base_url(); ?>assets/images/semester_reg/sem_slip/<?php echo $fee[0]['recipt_path'] ?>" />
					</div>
				</div>	
				</div>
                </div>
                <div class="box-footer">
                <?php echo form_open_multipart('student_sem_form/regular_form/regular_form_save');
	 echo form_hidden('lid', $lastId);
	 echo form_submit('submit','Confirm','class="btn btn-primary"').'  <button class="btn btn-primary" id="back"><< Back</button>';
	  echo form_close(); ?>
      	
				</div>
				
			</div>
           	
		
	</div>
	
</div>
<?php // print_r($carryover); ?>
	<script type="text/javascript">
    $(document).ready(function(){
    $('#back').click(function(){
        parent.history.back();
        return false;
    });
	});
    </script>