<?php echo form_open_multipart('student_sem_form/regular_form'); ?>
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
					<div class="col-md-2">
						<div class="form-group">
							<label for="studentName">Name of Course</label>
							<?php echo form_input(array('name'=>'nameofCourse','id'=>'nameofCourse','value'=>$this->session->userdata('course_id'),'disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="studentName">Name of Branch</label>
							<?php echo form_input(array('name'=>'nameofBranch','id'=>'nameofCourse','value'=>$this->session->userdata('branch_id'),'disabled'=>'disabled','class'=>'form-control',)) ?>
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
				<h5>Note: Red box Means Fail and Green Box Mean Pass (Please strike Out whichever is not applicable !)</h5>
				<div class="row">
					
					<div class="col-md-1">
						<div class="form-group has-success">
							<label for="studentName ">Ist</label>
							<?php echo form_input(array('name'=>'studentName','id'=>'studentName','value'=>'9.2','disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group has-error">
							<label for="inputError">IIed</label>
							<?php echo form_input(array('name'=>'nameofCourse','id'=>'inputError','value'=>'2.5','disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group has-success">
							<label for="studentName">IIIed</label>
							<?php echo form_input(array('name'=>'semester','id'=>'semester','value'=>'5','disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group has-success">
							<label for="studentName has-success">IVth</label>
							<?php echo form_input(array('name'=>'session','id'=>'session','value'=>'4','disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group has-error">
							<label for="studentName">Vth</label>
							<?php echo form_input(array('name'=>'session','id'=>'session','value'=>'2','disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group has-success">
							<label for="studentName">VIth</label>
							<?php echo form_input(array('name'=>'session','id'=>'session','value'=>'5','disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group has-success">
							<label for="studentName">VIIth</label>
							<?php echo form_input(array('name'=>'session','id'=>'session','value'=>'8','disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group has-success">
							<label for="studentName">VIIIth</label>
							<?php echo form_input(array('name'=>'session','id'=>'session','value'=>'4.1','disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group has-success">
							<label for="studentName">IXth</label>
							<?php echo form_input(array('name'=>'session','id'=>'session','value'=>'5.6','disabled'=>'disabled','class'=>'form-control',)) ?>
						</div>
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
								<?php 
								$ele=array();
								$i=0;
								function get_numeric($val) {
								  if (is_numeric($val)) {
									return $val + 0;
								  }
								  return 0;
								} 
								$s=0;
								foreach($subjects as $subject ){
									if(!is_float(get_numeric($subject['sequence']))){
								?>
								<tr>
									<td data-field="serialNo"><?php echo $subject['sequence']; echo form_hidden('seq'.$s, $subject['sequence']); ?></td>
									<td data-field="subjectCode"><?php echo $subject['subject_id']; echo form_hidden('sub_id'.$s, $subject['subject_id']); ?></td>
									<td data-field="subjectName"><?php echo $subject['name'] ?></td>
								</tr>
								
							<?php $s++; }else{
									array_push($ele,$subject);
									$ele[$i]; $i++;
							}}	echo form_hidden('corecount', $s); ?>
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
							<th>Subject Name</th>
							</tr>
							</thead>
							<tbody>
								<?php $k=0; $count = 0;
									for($j=0; $j<count($ele); $j++){
										
										if($j==0){
										$d ='<tr><td>'.(int)$ele[$j]['sequence'].form_hidden('elvs'.$j, (int)$ele[$j]['sequence']).'</td><td><select name="ele'.(int)get_numeric($ele[$j]['sequence']).'" class="form-control"><option value="'.$ele[$j]['subject_id'].'">'.$ele[$j]['subject_id'].' '.$ele[$j]['name'].'</option>';
										$count++;
										$eles=(int)get_numeric($ele[$j]['sequence']);
										}else if(((int)get_numeric($ele[$j-1]['sequence'])) == ((int)get_numeric($ele[$j]['sequence']))) {
											$d .='<option value="'.$ele[$j]['subject_id'].'">'.$ele[$j]['subject_id'].' '.$ele[$j]['name'].'</option>';
										}else{
											$d.='</select></td></tr><tr><td>'.(int)$ele[$j]['sequence'].form_hidden('elvs'.$j, (int)$ele[$j]['sequence']).'</td><td><select name="ele'.(int)get_numeric($ele[$j]['sequence']).'" class="form-control"><option value="'.$ele[$j]['subject_id'].'">'.$ele[$j]['subject_id'].' '.$ele[$j]['name'].'</option>';
											$count++;
										}if($j+1 == count($ele)){
											$d.='</select></td></tr>';
											echo $d; 
											}	
										}	?>
							</tbody>
						</table>							
					</div>
				</div>	
				</div>
			</div>
			<?php echo form_hidden('elvcount', $count); echo form_hidden('elvstart', $eles); } ?>
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
					<label for="subjectName">Pay Slip Upload</label>
					<?php echo form_upload(array('name'=>'slip','id'=>'slip',)) ?>
					</div>
				</div>	
				</div>
				<div class="box-footer">
				<?php echo form_hidden('aggr_id', $aid); echo form_submit('submit','Save Info','class="btn btn-primary"'); ?>
				</div>
			</div>
		
	</div>
	
</div>
<?php echo form_close(); ?>
