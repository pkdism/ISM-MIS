<section class="content invoice">
		<div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> Semester Registration Form</h2>
        	</div>
        </div>
        <div class="row invoice-info">
        	<div class="col-sm-8">
        	<div class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Name of student</strong></div>
            <div class="col-sm-8 invoice-col"><span style="text-transform:capitalize;"><?php echo $student[0]->salutation." ".$student[0]->first_name." ".$student[0]->middle_name." ".$student[0]->last_name; ?></span> / <?php echo $student[0]->name_in_hindi; ?></div><div style="clear:both;"></div>
            <div class="col-sm-4 invoice-col" ><strong>Admission No.</strong></div>
            <div class="col-sm-8 invoice-col"><?php echo $student[0]->admn_no; ?></div><div style="clear:both;"></div>
            <div class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Name of Course / Branch.</strong></div>
            <div class="col-sm-8 invoice-col"><?php echo  $this->sbasic_model->getCourseById($student[0]->course_id)->name; ?> / <?php echo $this->sbasic_model->getBranchById($student[0]->branch_id)->name; ?></div>
            <div class="col-sm-4 invoice-col" ><strong>Registering Semester / Session.</strong></div>
            <div class="col-sm-8 invoice-col"><?php echo $student[0]->semester+1; ?></div><div style="clear:both;">
             <div class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Form Date:</strong></div>
            <div class="col-sm-8 invoice-col"><?php echo $student[0]->timestamp; ?></div>
        </div>
        </div>
        <div class="col-sm-4">
        <img src="<?php echo base_url()."assets/images/".$student[0]->photopath ?>" alt="<?php echo $student[0]->salutation." ".$student[0]->first_name." ".$student[0]->middle_name." ".$student[0]->last_name; ?>" width="150" />
        </div>
        </div>
        
        <div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> GPA &amp; Result all previous Year</h2>
        	</div>
        </div>
         <div class="row">
         	<div class="col-xs-12">
             <?php 
				for($p=1; $p<=(int)$student[0]->semester; $p++){
						$q=$this->get_results->getGPAperSemester($student[0]->admn_no,$p);
						echo "<div class='col-sm-1'><a href='#'>$p. ".$q."</a></div>";	
				}
				?>
            </div>
         </div>
         <div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> Subject Registered for Current Semester </h2>
        	</div>
        </div>
          <div class="row">
          <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
          <thead>
              <th>Sl N.</th>
              <th>SUbject Code</th>
              <th>SUbject Name</th>
          </thead>
          <tbody>
          	  <?php
			  		
				 foreach($subjects as $subject) { 
				 	foreach($subject as $s) {
					?>
              <tr>
                <td><?php echo $s['sequence']; ?></td>
                <td><?php echo $s['subject_id']; ?></td>
                <td><?php echo $s['name'];  ?></td>
              </tr>
    	  <?php }}   foreach($confirm['ele'] as $s) { ?>
      <tr>
        <td><?php echo $s['sub_seq']; ?></td>
        <td><?php echo $s['sub_seq']; ?></td>
        <td><?php echo $s['name']; ?></td>
      </tr>
      <?php } ?>
          </tbody>
          </table>
          </div>
          </div>
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
                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $carryover[0]['fee_date'] ?>" />
                </div>
                <div class="form-group">
                	<label>Amount Paid</label>
                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $carryover[0]['fee_amt'] ?>" />
                </div>
                <div class="form-group">
                	<label>Transaction id / Reference No.</label>
                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $carryover[0]['trans_id'] ?>" />
                </div>
                </div>
                <div class="col-sm-6">
               		<img src="<?php echo base_url(); ?>assets/images/semester_reg/sem_slip/<?php echo $carryover[0]['fee_slip'] ?>" alt="Pay Slip of Carry Over" width="200"  />
                </div>
                </div>
            </div>
            
            </div>
            <? } ?>
        <div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> Details of Fee Deposite. </h2>
        	</div>
        </div>
        <div class="row invoice-info">
        <div class="col-sm-6">
        	<div class="col-sm-6 invoice-col" style="background:#F4F4F4;"><strong>Date of Payment</strong></div>
            <div class="col-sm-6 invoice-col"><?php echo $student[0]->fee_date; ?></div>
             <div class="col-sm-6 invoice-col" style="background:#F4F4F4;"><strong>Amount Paid</strong></div>
            <div class="col-sm-6 invoice-col"><?php echo $student[0]->fee_amt; ?></div>
             <div class="col-sm-6 invoice-col" style="background:#F4F4F4;"><strong>Tras. ID / Ref. ID</strong></div>
            <div class="col-sm-6 invoice-col"><?php echo $student[0]->transaction_id; ?></div>
           </div>
          <div class="col-sm-6">
          <div class="col-sm-6 invoice-col"><img src="<?php echo base_url()."assets/images/semester_reg/sem_slip/".$student[0]->recipt_path; ?>" alt="" width="200" />
          
           <?php if($student[0]->late_recipt_path){ ?>
           <img src="<?php echo base_url()."assets/images/semester_reg/sem_slip/".$student[0]->late_recipt_path; ?>" alt="" width="200" />
           <?php } ?>
           </div>
          </div>
         </div>
         <div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> form status </h2>
        	</div>
        </div>
        <div class="row">
        <div class="col-sm-3" style="background:#F4F4F4;"><strong>Department Status:</strong></div>
        <div class="col-sm-3" ><?php echo ($student[0]->hod_status == 0 ? '<span class="label label-warning">Pending</span>' :($student[0]->hod_status == 2 ? '<span class="label label-danger">Rejected</span>' :'<span class="label label-success">Approved</span>')); ?></div>
        <div class="col-sm-3" style="background:#F4F4F4;"><strong>Acdmic Status:</strong></div>
        <div class="col-sm-3" >
		<?php echo ($student[0]->acdmic_status == 0 ? '<span class="label label-warning">Pending</span>' :($student[0]->acdmic_status == 2 ? '<span class="label label-danger">Rejected</span>' :'<span class="label label-success">Approved</span>')); ?></div>
        </div>
        <div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> Set Department Side Status </h2>
        	</div>
        </div>
        

	
</scetion>


<?php print_r($carryover) ?>