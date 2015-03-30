<?php $ui = new UI();
echo '<div id="print" >';
	$head = $ui->row()->open();
		$h_col = $ui->col()->width(12)->open();

			//Selecting Initial tab pane.
			if($step < 0 || $step > 5)	$step=5;

			$status1 = $status2 = $status3 = $status4 = $status5 = '';
			if($emp_validation_details) {

				$pending_status = $ui->label()->uiType('info')->text('Pending');
				$rejected_status = $ui->label()->uiType('danger')->text('Rejected');

				if($emp_validation_details->profile_pic_status=='pending')	$status1 = $pending_status;
				else if($emp_validation_details->profile_pic_status=='rejected')	$status1 = $rejected_status;

				if($status1=='' && $emp_validation_details->basic_details_status=='pending')	$status1 = $pending_status;
				else if($status1=='' && $emp_validation_details->basic_details_status=='rejected')	$status1 = $rejected_status;

				if($emp_validation_details->prev_exp_status=='pending')	$status2 = $pending_status;
				else if($emp_validation_details->prev_exp_status=='rejected')	$status2 = $rejected_status;

				if($emp_validation_details->family_details_status=='pending')	$status3 = $pending_status;
				else if($emp_validation_details->family_details_status=='rejected')	$status3 = $rejected_status;

				if($emp_validation_details->educational_status=='pending')	$status4 = $pending_status;
				else if($emp_validation_details->educational_status=='rejected')	$status4 = $rejected_status;

				if($emp_validation_details->stay_status=='pending')	$status5 = $pending_status;
				else if($emp_validation_details->stay_status=='rejected')	$status5 = $rejected_status;
			}

			$tabbox = $ui->tabBox()
							->tab('all','<br>'.$ui->icon('user').'All Details',$step==5)
							->tab('basic_details',$status1.'<br>Basic Details',$step==0)
							->tab('prev_emp',$status2.'<br>Employment Details',$step==1)
							->tab('emp_fam',$status3.'<br>Family Member Details',$step==2)
							->tab('emp_edu',$status4.'<br>Educational Qualifications',$step==3)
							->tab('last_five',$status5.'<br>Stay Details',$step==4)
							->open();

				$basic = $ui->tabPane()->id('basic_details');
				if($step==0)	$basic->active();
				$basic->open();
					if($emp) {
						$data['name'] = $emp->salutation.'. '.ucwords(trim($emp->first_name)).' '.trim(ucwords(trim($emp->middle_name)).' '.ucwords(trim($emp->last_name)));
						$data['department']=$this->departments_model->getDepartmentById($emp->dept_id)->name;
    					$data['designation']=$this->designations_model->getDesignationById($emp->designation)->name;
    					$data['permanent_pretty'] = $permanent_address->line1.',<br>'.((trim($permanent_address->line2)=='')? '':$permanent_address->line2.',<br>').ucwords($permanent_address->city).', '.ucwords($permanent_address->state).' - '.$permanent_address->pincode.'<br>'.ucwords($permanent_address->country).'<br>Contact no. '.$permanent_address->contact_no;
				        $data['present_pretty'] = $present_address->line1.',<br>'.((trim($present_address->line2)=='')? '':$present_address->line2.',<br>').ucwords($present_address->city).', '.ucwords($present_address->state).' - '.$present_address->pincode.'<br>'.ucwords($present_address->country).'<br>Contact no. '.$present_address->contact_no;

    					if($emp_validation_details)
					    {
					        if($emp_validation_details->profile_pic_status=='pending')
					            $ui->callout()->title("Pending".$ui->label()->uiType('info')->id('pending_pic')->classes('pull-right')->text('Show'))->desc('Profile Picture is not yet validated.<br><img id="pending_photo" src="'.base_url().'assets/images/'.$pending_photo.'"  height="150" />')->uiType('info')->show();
					        else if($emp_validation_details->profile_pic_status=='rejected')
					        {
					            $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 0));
					            $ui->callout()->title("Rejected".$ui->label()->uiType('danger')->id('pending_pic')->classes('pull-right')->text('Show'))->desc('Please contact the Establishment Section for the same.'.(($reject)? '<br>Reason behind rejection : '.$reject->reason : '').'<br><img id="pending_photo" src="'.base_url().'assets/images/'.$pending_photo.'"  height="150" />')->uiType('danger')->show();
					        }
					    }
						view_profile_pic($emp->photopath);

						$basic_details_status = $pending_data = false;	//initializing
						if($emp_validation_details)
					    {
					        if($emp_validation_details->basic_details_status=='pending')
					            $ui->callout()->title("Pending".$ui->label()->uiType('info')->id('pending_basic')->classes('pull-right')->text('Show'))->desc("Basic Details are not yet validated.")->uiType('info')->show();
					        else if($emp_validation_details->basic_details_status=='rejected')
					        {
					            $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 1));
					            $ui->callout()->title("Rejected".$ui->label()->uiType('danger')->id('pending_basic')->classes('pull-right')->text('Show'))->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
					        }

					        if($pending_emp && $pending_permanent_address && $pending_present_address) {
						        $pending_data['name'] = $pending_emp->salutation.'. '.ucwords(trim($pending_emp->first_name)).' '.trim(ucwords(trim($pending_emp->middle_name)).' '.ucwords(trim($pending_emp->last_name)));
								$pending_data['department']=$this->departments_model->getDepartmentById($pending_emp->dept_id)->name;
	    						$pending_data['designation']=$this->designations_model->getDesignationById($pending_emp->designation)->name;

								$pending_data['permanent_pretty'] = $pending_permanent_address->line1.',<br>'.((trim($pending_permanent_address->line2)=='')? '':$pending_permanent_address->line2.',<br>').ucwords($pending_permanent_address->city).', '.ucwords($pending_permanent_address->state).' - '.$pending_permanent_address->pincode.'<br>'.ucwords($pending_permanent_address->country).'<br>Contact no. '.$pending_permanent_address->contact_no;
					        	$pending_data['present_pretty'] = $pending_present_address->line1.',<br>'.((trim($pending_present_address->line2)=='')? '':$pending_present_address->line2.',<br>').ucwords($pending_present_address->city).', '.ucwords($pending_present_address->state).' - '.$pending_present_address->pincode.'<br>'.ucwords($pending_present_address->country).'<br>Contact no. '.$pending_present_address->contact_no;
					        }
						    
						    $basic_details_status = $emp_validation_details->basic_details_status;
					    }
						view_basic_details($data,$emp,$ft,$pending_data,$pending_emp,$pending_ft,$basic_details_status);
					}
					else
						$ui->callout()->title('Not Found')->desc("Your details have not been updated. Please check after some time.")->uiType('warning')->show();
				$basic->close();

				$prev_emp = $ui->tabPane()->id('prev_emp');
				if($step==1)	$prev_emp->active();
				$prev_emp->open();
					$prev_exp_status = false;
					if($emp_prev_exp_details) {
						if($emp_validation_details)
						{
							$prev_exp_status = $emp_validation_details->prev_exp_status;
							if($emp_validation_details->prev_exp_status=='pending')
								$ui->callout()->title("Pending".$ui->label()->uiType('info')->id('pending_prev_exp')->classes('pull-right')->text('Show'))->desc("Previous Employment Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->prev_exp_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 2));
								$ui->callout()->title("Rejected".$ui->label()->uiType('danger')->id('rejected_prev_exp')->classes('pull-right')->text('Show'))->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_prev_emp_details($emp_prev_exp_details,$pending_emp_prev_exp_details,$prev_exp_status);
					}
					else
						$ui->callout()->title('Not Found')->desc("Your details have not been updated. Please check after some time.")->uiType('warning')->show();
				$prev_emp->close();

				$emp_fam = $ui->tabPane()->id('emp_fam');
				if($step==2)	$emp_fam->active();
				$emp_fam->open();
					$family_details_status = false;
					if($emp_family_details) {
						if($emp_validation_details)
						{
							$family_details_status = $emp_validation_details->family_details_status;
							if($emp_validation_details->family_details_status=='pending')
								$ui->callout()->title("Pending".$ui->label()->uiType('info')->id('pending_family')->classes('pull-right')->text('Show'))->desc("Dependent Family Member Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->family_details_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 3));
								$ui->callout()->title("Rejected".$ui->label()->uiType('danger')->id('rejected_family')->classes('pull-right')->text('Show'))->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_family_details($emp_family_details,$pending_emp_family_details,$family_details_status);
					}
					else
						$ui->callout()->title('Not Found')->desc("Your details have not been updated. Please check after some time.")->uiType('warning')->show();
				$emp_fam->close();

				$emp_edu = $ui->tabPane()->id('emp_edu');
				if($step==3)	$emp_edu->active();
				$emp_edu->open();
					$educational_status = false;
					if($emp_education_details) {
						if($emp_validation_details)
						{
							$educational_status = $emp_validation_details->educational_status;
							if($emp_validation_details->educational_status=='pending')
								$ui->callout()->title("Pending".$ui->label()->uiType('info')->id('pending_education')->classes('pull-right')->text('Show'))->desc("Educational Qualificatons are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->educational_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 4));
								$ui->callout()->title("Rejected".$ui->label()->uiType('danger')->id('rejected_education')->classes('pull-right')->text('Show'))->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_education_details($emp_education_details,$pending_emp_education_details, $educational_status);
					}
					else
						$ui->callout()->title('Not Found')->desc("Your details have not been updated. Please check after some time.")->uiType('warning')->show();
				$emp_edu->close();

				$last_five = $ui->tabPane()->id('last_five');
				if($step==4)	$last_five->active();
				$last_five->open();
					$stay_status = false;
					if($emp_last5yrstay_details) {
						if($emp_validation_details)
						{
							$stay_status = $emp_validation_details->stay_status;
							if($emp_validation_details->stay_status=='pending')
								$ui->callout()->title("Pending".$ui->label()->uiType('info')->id('pending_last_five')->classes('pull-right')->text('Show'))->desc("Last 5 Year Stay Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->stay_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 5));
								$ui->callout()->title("Rejected".$ui->label()->uiType('danger')->id('rejected_last_five')->classes('pull-right')->text('Show'))->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_stay_details($emp_last5yrstay_details,$pending_emp_last5yrstay_details, $stay_status);
					}
					else
						$ui->callout()->title('Not Found')->desc("Your details have not been updated. Please check after some time.")->uiType('warning')->show();
				$last_five->close();

				$all = $ui->tabPane()->id('all');
				if($step==5)	$all->active();
				$all->open();
					if($emp) {
						/*$data['name'] = $emp->salutation.'. '.ucwords(trim($emp->first_name)).' '.trim(ucwords(trim($emp->middle_name)).' '.ucwords(trim($emp->last_name)));
						$data['department']=$this->departments_model->getDepartmentById($emp->dept_id)->name;
    					$data['designation']=$this->designations_model->getDesignationById($emp->designation)->name;
    					$data['permanent_pretty'] = $permanent_address->line1.',<br>'.((trim($permanent_address->line2)=='')? '':$permanent_address->line2.',<br>')
                    						.ucwords($permanent_address->city).', '.ucwords($permanent_address->state).' - '.$permanent_address->pincode.'<br>'
                    						.ucwords($permanent_address->country).'<br>
                    						Contact no. '.$permanent_address->contact_no;

				        $data['present_pretty'] = $present_address->line1.',<br>'.((trim($present_address->line2)=='')? '':$present_address->line2.',<br>')
						                    .ucwords($present_address->city).', '.ucwords($present_address->state).' - '.$present_address->pincode.'<br>'
						                    .ucwords($present_address->country).'<br>
						                    Contact no. '.$present_address->contact_no;
*/
						/*if($emp_validation_details)
					    {
					        if($emp_validation_details->profile_pic_status=='pending')
					            $ui->callout()->title("Pending")->desc("Profile Picture is not yet validated.")->uiType('info')->show();
					        else if($emp_validation_details->profile_pic_status=='rejected')
					        {
					            $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 0));
					            $ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
					        }
					    }*/
						view_profile_pic($emp->photopath);

						/*if($emp_validation_details)
					    {
					        if($emp_validation_details->basic_details_status=='pending')
					            $ui->callout()->title("Pending")->desc("Basic Details are not yet validated.")->uiType('info')->show();
					        else if($emp_validation_details->basic_details_status=='rejected')
					        {
					            $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 1));
					            $ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
					        }
					    }*/
						view_basic_details($data,$emp,$ft);
					}
					if($emp_prev_exp_details) {
						/*if($emp_validation_details)
						{
							if($emp_validation_details->prev_exp_status=='pending')
								$ui->callout()->title("Pending")->desc("Previous Employment Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->prev_exp_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 2));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}*/
						view_prev_emp_details($emp_prev_exp_details);
					}
					if($emp_family_details) {
						/*if($emp_validation_details)
						{
							if($emp_validation_details->family_details_status=='pending')
								$ui->callout()->title("Pending")->desc("Dependent Family Member Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->family_details_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 3));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}*/
						view_family_details($emp_family_details);
					}
					if($emp_education_details) {
						/*if($emp_validation_details)
						{
							if($emp_validation_details->educational_status=='pending')
								$ui->callout()->title("Pending")->desc("Educational Qualificatons are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->educational_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 4));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}*/
						view_education_details($emp_education_details);
					}
					if($emp_last5yrstay_details) {
						/*if($emp_validation_details)
						{
							if($emp_validation_details->stay_status=='pending')
								$ui->callout()->title("Pending")->desc("Last 5 Year Stay Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->stay_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 5));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}*/
						view_stay_details($emp_last5yrstay_details);
					}
				$all->close();

			$tabbox->close();
		$h_col->close();

		echo '<center>';
		$ui->button()
			->uiType('primary')
			->id('print_btn')
			->value('PRINT')
			->show();
		echo '</center>';

	$head->close();
echo '</div>';

function view_profile_pic($photo) {
    echo '<center><img src="'.base_url().'assets/images/'.$photo.'"  height="150" /></center><br>';
}


function view_basic_details($data,$emp,$ft,$pending_data=false,$pending_emp=false,$pending_ft=false,$status=false) {
	$ui = new UI();
	$uiType = ($status=='pending')? 'info':'danger';
    $row = $ui->row()->open();
    	$col = $ui->col()->open();
    		echo '<h3 class="page-header" align="center">Employee Details</h3>';

  			$row1 = $ui->row()->open();
  				$col1 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Name</label><br>'.$data['name'];
  					if($pending_data && $data['name'] != $pending_data['name']) echo '<br><span class="'.$status.'">'.$pending_data['name'].$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col1->close();
  				$col2 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Gender</label><br>'.(($emp->sex == 'm')? 'Male':(($emp->sex == 'f')? 'Female':'Others'));
  					if($pending_emp && $emp->sex != $pending_emp->sex) {
  						$sex_val = ($pending_emp->sex=='m')? 'Male':(($pending_emp->sex=='f')? 'Female':'Others');
  						echo '<br><span class="'.$status.'">'.$sex_val.$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  					}
  				$col2->close();
  				$col3 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>DOB</label><br>'.date('d M Y', strtotime($emp->dob));
  					if($pending_emp && $emp->dob != $pending_emp->dob) echo '<br><span class="'.$status.'">'.date('d M Y', strtotime($pending_emp->dob)).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col3->close();
  				$col4 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Category</label><br>'.ucwords($emp->category);
  					if($pending_emp && $emp->category != $pending_emp->category) echo '<br><span class="'.$status.'">'.ucwords($pending_emp->category).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col4->close();
  				$col5 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Physically Challenged</label><br>'.ucwords($emp->physically_challenged);
  					if($pending_emp && $emp->physically_challenged != $pending_emp->physically_challenged) echo '<br><span class="'.$status.'">'.ucwords($pending_emp->physically_challenged).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col5->close();
  			$row1->close();
  			echo '<br>';
			$row2 = $ui->row()->open();
  				$col1 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Department</label><br>'.$data['department'];
  					if($pending_data && $data['department'] != $pending_data['department']) echo '<br><span class="'.$status.'">'.$pending_data['department'].$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col1->close();
  				$col2 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Designation</label><br>'.ucwords($data['designation']);
  					if($pending_data && $data['designation'] != $pending_data['designation']) echo '<br><span class="'.$status.'">'.$pending_data['designation'].$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col2->close();
  				$col3 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Marital Status</label><br>'.ucwords($emp->marital_status);
  					if($pending_emp && $emp->marital_status != $pending_emp->marital_status) echo '<br><span class="'.$status.'">'.ucwords($pending_emp->marital_status).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col3->close();
  				$col4 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Place of Birth</label><br>'.ucwords($emp->birth_place);
  					if($pending_emp && $emp->birth_place != $pending_emp->birth_place) echo '<br><span class="'.$status.'">'.ucwords($pending_emp->birth_place).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col4->close();
  				$col5 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Kashmiri Immigrant</label><br>'.ucwords($emp->kashmiri_immigrant);
  					if($pending_emp && $emp->kashmiri_immigrant != $pending_emp->kashmiri_immigrant) echo '<br><span class="'.$status.'">'.ucwords($pending_emp->kashmiri_immigrant).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col5->close();
  			$row2->close();
			echo '<br>';
			$dt = DateTime::createFromFormat("Y-m-d", $emp->retirement_date);
			if($pending_emp)	$pending_dt = DateTime::createFromFormat("Y-m-d", $pending_emp->retirement_date);
			$row3 = $ui->row()->open();
  				$col1 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Father\'s Name</label><br>'.ucwords($emp->father_name);
  					if($pending_emp && $emp->father_name != $pending_emp->father_name) echo '<br><span class="'.$status.'">'.ucwords($pending_emp->father_name).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col1->close();
  				$col2 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Mother\'s Name</label><br>'.ucwords($emp->mother_name);
  					if($pending_emp && $emp->mother_name != $pending_emp->mother_name) echo '<br><span class="'.$status.'">'.ucwords($pending_emp->mother_name).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col2->close();
  				$col3 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Date of Joining</label><br>'.date('d M Y', strtotime($emp->joining_date));
  					if($pending_emp && $emp->joining_date != $pending_emp->joining_date) echo '<br><span class="'.$status.'">'.date('d M Y', strtotime($pending_emp->joining_date)).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col3->close();
  				$col4 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Employment Nature</label><br>'.ucwords($emp->employment_nature);
  					if($pending_emp && $emp->employment_nature != $pending_emp->employment_nature) echo '<br><span class="'.$status.'">'.ucwords($pending_emp->employment_nature).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col4->close();
  				$col5 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Date of Retirement</label><br>'.$dt->format("d M Y");
  					if($pending_emp && $emp->retirement_date != $pending_emp->retirement_date) echo '<br><span class="'.$status.'">'.$pending_dt->format("d M Y").$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col5->close();
  			$row3->close();
  			echo '<br>';
  			$row4 = $ui->row()->open();
  				$col1 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Email</label><br>'.$emp->email;
  					if($pending_emp && $emp->email != $pending_emp->email) echo '<br><span class="'.$status.'">'.$pending_emp->email.$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col1->close();
  				$col2 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Mobile no.</label><br>'.$emp->mobile_no;
  					if($pending_emp && $emp->mobile_no != $pending_emp->mobile_no) echo '<br><span class="'.$status.'">'.$pending_emp->mobile_no.$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col2->close();
  			$row4->close();
  			echo '<br>';
  			$row5 = $ui->row()->open();
  				$col1 = $ui->col()->width(6)->t_width(6)->m_width(6)->open();
  					echo '<label>Present Address</label><br>'.$data['present_pretty'];
  					if($pending_data && $data['present_pretty'] != $pending_data['present_pretty']) echo '<br><span class="'.$status.'">'.$pending_data['present_pretty'].$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col1->close();
  				$col2 = $ui->col()->width(6)->t_width(6)->m_width(6)->open();
  					echo '<label>Permanent Address</label><br>'.$data['permanent_pretty'];
  					if($pending_data && $data['permanent_pretty'] != $pending_data['permanent_pretty']) echo '<br><span class="'.$status.'">'.$pending_data['permanent_pretty'].$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col2->close();
  			$row5->close();

  					$emp_type='';
			        if(in_array('ft',$emp->auth_id)) $emp_type = 'Faculty';
			        if(in_array('nfta',$emp->auth_id)) $emp_type = 'Non Faculty Academic';
			        if(in_array('nftn',$emp->auth_id)) $emp_type = 'Non Faculty Non Academic';

			        if($pending_emp) {
				        $pending_emp_type='';
				        if(in_array('ft',$pending_emp->auth_id)) $pending_emp_type = 'Faculty';
				        if(in_array('nfta',$pending_emp->auth_id)) $pending_emp_type = 'Non Faculty Academic';
				        if(in_array('nftn',$pending_emp->auth_id)) $pending_emp_type = 'Non Faculty Non Academic';
				    }

			echo '<br>';
			$row6 = $ui->row()->open();
  				$col1 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Employee Type</label><br>'.$emp_type;
  					if($pending_emp && $emp_type != $pending_emp_type) echo '<br><span class="'.$status.'">'.$pending_emp_type.$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col1->close();
  				$col2 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Research Interest</label><br>'.((!in_array('ft',$emp->auth_id))?   'NA' : ucwords($ft->research_interest));

  					if($pending_emp) {
	  					if(in_array('ft',$emp->auth_id) && in_array('ft',$pending_emp->auth_id))
	  						$res_is_equal = ($ft->research_interest == $pending_ft->research_interest)?	true:false;
	  					else if(!in_array('ft',$emp->auth_id) && !in_array('ft',$pending_emp->auth_id))
	  						$res_is_equal = true;
	  					else 	$res_is_equal = false;

	  					if(!$res_is_equal) echo '<br><span class="'.$status.'">'.((!in_array('ft',$pending_emp->auth_id))?   'NA' : ucwords($pending_ft->research_interest)).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
 					}
  				$col2->close();
  				$col3 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Religion</label><br>'.ucwords($emp->religion);
  					if($pending_emp && $emp->religion != $pending_emp->religion) echo '<br><span class="'.$status.'">'.ucwords($pending_emp->religion).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col3->close();
  				$col4 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Nationality</label><br>'.ucwords($emp->nationality);
  					if($pending_emp && $emp->nationality != $pending_emp->nationality) echo '<br><span class="'.$status.'">'.ucwords($pending_emp->nationality).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col4->close();
  			$row6->close();
  			echo '<br>';
			$row7 = $ui->row()->open();
  				$col1 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Pay Scale</label><br><u>Pay Band</u> =>'.strtoupper($emp->pay_band).' ('.$emp->pay_band_description.')<br>
                    <u>Grade Pay</u> =>'.$emp->grade_pay.'<br>
                    <u>Basic Pay</u> =>'.$emp->basic_pay;
                    if($pending_emp && !($emp->pay_band == $pending_emp->pay_band && $emp->grade_pay == $pending_emp->grade_pay && $emp->basic_pay == $pending_emp->basic_pay)) echo '<br><span class="'.$status.'"><u>Pay Band</u> =>'.strtoupper($pending_emp->pay_band).' ('.$pending_emp->pay_band_description.')<br>
                    													<u>Grade Pay</u> =>'.$pending_emp->grade_pay.'<br>
                    													<u>Basic Pay</u> =>'.$pending_emp->basic_pay.$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col1->close();
  				$col2 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Office no.</label><br>'.$emp->office_no;
  					if($pending_emp && $emp->office_no != $pending_emp->office_no) echo '<br><span class="'.$status.'">'.$pending_emp->office_no.$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col2->close();
  				$col3 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Fax</label><br>'.$emp->fax;
  					if($pending_emp && $emp->fax != $pending_emp->fax) echo '<br><span class="'.$status.'">'.$pending_emp->fax.$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col3->close();
  				$col4 = $ui->col()->width(2)->t_width(2)->m_width(6)->open();
  					echo '<label>Hobbies</label><br>'.((trim(ucfirst($emp->hobbies))=='')? 'NA':ucfirst($emp->hobbies));
  					if($pending_emp && $emp->hobbies != $pending_emp->hobbies) echo '<br><span class="'.$status.'">'.((trim(ucfirst($pending_emp->hobbies))=='')? 'NA':ucfirst($pending_emp->hobbies)).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col4->close();
  				$col5 = $ui->col()->width(3)->t_width(3)->m_width(6)->open();
  					echo '<label>Favourite Past Time</label><br>'.((trim(ucfirst($emp->fav_past_time))=='')? 'NA':ucfirst($emp->fav_past_time));
  					if($pending_emp && $emp->fav_past_time != $pending_emp->fav_past_time) echo '<br><span class="'.$status.'">'.((trim(ucfirst($pending_emp->fav_past_time))=='')? 'NA':ucfirst($pending_emp->fav_past_time)).$ui->label()->uiType($uiType)->text(ucwords($status)).'</span>';
  				$col5->close();
  			$row7->close();
    	$col->close();
    $row->close();
}


function view_prev_emp_details($emp_prev_exp_details,$pending_emp_prev_exp_details = false, $status = false) {
	$ui = new UI();
	echo '<h3 class="page-header" align="center">Previous Employment Details</h3>';

	$table = $ui->table()->id('tbl2')->responsive()->condensed()->bordered()->striped()->open();
            echo '<thead><tr align="center">
                <td style="vertical-align:middle"><b>Full address of Employer</b></td>
                <td style="vertical-align:middle"><b>Position held</b></td>
                <td style="vertical-align:middle"><b>Date of joining</b></td>
	        	<td style="vertical-align:middle"><b>Date of leaving</b></td>
                <td style="vertical-align:middle"><b>Pay Scale</b></td>
                <td style="vertical-align:middle"><b>Remarks</b></td>
            </tr>
            </thead><tbody>';

            foreach($emp_prev_exp_details as $row) {
                if($row->remarks == "") $remarks='NA';
                else    $remarks = $row->remarks;
                echo '<tr name="row[]" align="center">
                        <td>'.ucwords($row->address).'</td>
                        <td>'.ucwords($row->designation).'</td>
                        <td>'.date('d M Y', strtotime($row->from)).'</td>
                        <td>'.date('d M Y', strtotime($row->to)).'</td>
                        <td>'.$row->pay_scale.'</td>
                        <td>'.ucfirst($remarks).'</td>
                		</tr>';
            }
            echo'</tbody>';
    $table->close();

    if($pending_emp_prev_exp_details) {
    	$uiType = ($status == 'pending')? 'info':'danger';
	    echo '<div id = "pending_emp_prev_exp_details"><h3 class="page-header" align="center">Previous Employment Details '.$ui->label()->uiType($uiType)->text(ucwords($status)).'</h3>';
	    $table = $ui->table()->responsive()->condensed()->bordered()->striped()->open();
            echo '<thead><tr align="center">
                <td style="vertical-align:middle"><b>Full address of Employer</b></td>
                <td style="vertical-align:middle"><b>Position held</b></td>
                <td style="vertical-align:middle"><b>Date of joining</b></td>
	        	<td style="vertical-align:middle"><b>Date of leaving</b></td>
                <td style="vertical-align:middle"><b>Pay Scale</b></td>
                <td style="vertical-align:middle"><b>Remarks</b></td>
            </tr>
            </thead><tbody>';

            foreach($pending_emp_prev_exp_details as $row) {
                if($row->remarks == "") $remarks='NA';
                else    $remarks = $row->remarks;
                echo '<tr name="row[]" align="center">
                        <td>'.ucwords($row->address).'</td>
                        <td>'.ucwords($row->designation).'</td>
                        <td>'.date('d M Y', strtotime($row->from)).'</td>
                        <td>'.date('d M Y', strtotime($row->to)).'</td>
                        <td>'.$row->pay_scale.'</td>
                        <td>'.ucfirst($remarks).'</td>
                		</tr>';
            }
            echo'</tbody>';
        $table->close();
        echo '</div>';
    }
}


function view_family_details($emp_family_details,$pending_emp_family_details = false, $status = false) {
	$ui = new UI();
	echo '<h3 class="page-header" align="center">Dependent Family Member Details</h3>';

	$table = $ui->table()->id('tbl3')->responsive()->bordered()->striped()->open();
		echo '<thead><tr align="center">
		    <td style="vertical-align:middle"><b>Name</b></td>
		    <td style="vertical-align:middle"><b>Relationship</b></td>
		    <td style="vertical-align:middle"><b>Date of Birth</b></td>
		    <td style="vertical-align:middle"><b>Profession</b></td>
		    <td style="vertical-align:middle"><b>Present Postal Address</b></td>
		    <td style="vertical-align:middle"><b>Active/Inactive</b></td>
		    <td colspan="2" style="vertical-align:middle"><b>Photograph</b></td>
		    </tr>
		    </thead><tbody>';
		foreach($emp_family_details as $row) {
		    if($row->active_inactive=="Active")
		        $color="#00a65a";
		    else
		        $color="#f56954";
		    echo '<tr name="row[]" align="center" >
		                <td>'.ucwords($row->name).'</td>
		                <td>'.$row->relationship.'</td>
		                <td>'.date('d M Y', strtotime($row->dob)).'<br>(Age: '.floor((time() - strtotime($row->dob))/(365*24*60*60)).' years)</td>
		                <td>'.ucwords($row->profession).'</td>
		                <td>'.$row->present_post_addr.'</td>
		                <td><b><font color="'.$color.'">'.$row->active_inactive.'</font></b></td>
		                <td><img src="'.base_url().'assets/images/'.$row->photopath.'" height="150"/></td>
		        </tr>';
		}
		echo'</tbody>';
    $table->close();

    if($pending_emp_family_details) {
    	$uiType = ($status == 'pending')? 'info':'danger';
	    echo '<div id = "pending_emp_family_details"><h3 class="page-header" align="center">Dependent Family Member Details '.$ui->label()->uiType($uiType)->text(ucwords($status)).'</h3>';
	    $table = $ui->table()->responsive()->bordered()->striped()->open();
			echo '<thead><tr align="center">
			    <td style="vertical-align:middle"><b>Name</b></td>
			    <td style="vertical-align:middle"><b>Relationship</b></td>
			    <td style="vertical-align:middle"><b>Date of Birth</b></td>
			    <td style="vertical-align:middle"><b>Profession</b></td>
			    <td style="vertical-align:middle"><b>Present Postal Address</b></td>
			    <td style="vertical-align:middle"><b>Active/Inactive</b></td>
			    <td colspan="2" style="vertical-align:middle"><b>Photograph</b></td>
			    </tr>
			    </thead><tbody>';

            foreach($pending_emp_family_details as $row) {
			    if($row->active_inactive=="Active")
			        $color="#00a65a";
			    else
			        $color="#f56954";
			    echo '<tr name="row[]" align="center" >
			                <td>'.ucwords($row->name).'</td>
			                <td>'.$row->relationship.'</td>
			                <td>'.date('d M Y', strtotime($row->dob)).'<br>(Age: '.floor((time() - strtotime($row->dob))/(365*24*60*60)).' years)</td>
			                <td>'.ucwords($row->profession).'</td>
			                <td>'.$row->present_post_addr.'</td>
			                <td><b><font color="'.$color.'">'.$row->active_inactive.'</font></b></td>
			                <td><img src="'.base_url().'assets/images/'.$row->photopath.'" height="150"/></td>
			        </tr>';
			}
			echo'</tbody>';
        $table->close();
        echo '</div>';
    }
}


function view_education_details($emp_education_details,$pending_emp_education_details = false, $status = false) {
	$ui = new UI();
	echo '<h3 class="page-header" align="center">Educational Qualifications</h3>';

	$table = $ui->table()->id('tbl4')->responsive()->bordered()->striped()->open();
        echo '<thead><tr align="center">
            <td style="vertical-align:middle"><b>Examination</b></td>
            <td style="vertical-align:middle"><b>Course(Specialization)</b></td>
            <td style="vertical-align:middle"><b>College/University/Institute</b></td>
            <td style="vertical-align:middle"><b>Year</b></td>
            <td style="vertical-align:middle"><b>Percentage/Grade</b></td>
            <td style="vertical-align:middle"><b>Class/Division</b></td>
            </tr>
            </thead><tbody>';

        foreach($emp_education_details as $row)
        {
            echo '<tr name="row[]" align="center">
                    <td>'.strtoupper($row->exam).'</td>
                    <td>'.strtoupper($row->branch).'</td>
                    <td>'.strtoupper($row->institute).'</td>
                    <td>'.$row->year.'</td>
                    <td>'.strtoupper($row->grade).'</td>
                    <td>'.ucwords($row->division).'</td>
                </tr>';
        }
        echo'</tbody>';
    $table->close();

    if($pending_emp_education_details) {
    	$uiType = ($status == 'pending')? 'info':'danger';
	    echo '<div id = "pending_emp_education_details"><h3 class="page-header" align="center">Educational Qualifications '.$ui->label()->uiType($uiType)->text(ucwords($status)).'</h3>';
	    $table = $ui->table()->responsive()->bordered()->striped()->open();
			echo '<thead><tr align="center">
		            <td style="vertical-align:middle"><b>Examination</b></td>
		            <td style="vertical-align:middle"><b>Course(Specialization)</b></td>
		            <td style="vertical-align:middle"><b>College/University/Institute</b></td>
		            <td style="vertical-align:middle"><b>Year</b></td>
		            <td style="vertical-align:middle"><b>Percentage/Grade</b></td>
		            <td style="vertical-align:middle"><b>Class/Division</b></td>
		            </tr>
		            </thead><tbody>';

            foreach($pending_emp_education_details as $row)
	        {
	            echo '<tr name="row[]" align="center">
	                    <td>'.strtoupper($row->exam).'</td>
	                    <td>'.strtoupper($row->branch).'</td>
	                    <td>'.strtoupper($row->institute).'</td>
	                    <td>'.$row->year.'</td>
	                    <td>'.strtoupper($row->grade).'</td>
	                    <td>'.ucwords($row->division).'</td>
	                </tr>';
	        }
	        echo'</tbody>';
        $table->close();
        echo '</div>';
    }
}


function view_stay_details($emp_last5yrstay_details,$pending_emp_last5yrstay_details = false, $status = false) {
	$ui = new UI();
	echo '<h3 class="page-header" align="center">Last 5 Year Stay Details</h3>';

    $table = $ui->table()->id('tbl5')->responsive()->bordered()->striped()->open();
        echo '<thead><tr align="center">
				<td colspan=2 style="vertical-align:middle" ><b>Duration</b></td>
				<td rowspan=2 style="vertical-align:middle" ><b>Residential Address</b></td>
				<td rowspan=2 style="vertical-align:middle" ><b>Name of District Headquarters</b></td>
        	</tr>
        	<tr align="center">
            	<td style="vertical-align:middle"><b>From</b></td>
            	<td style="vertical-align:middle"><b>To</b></td>
        	</tr></thead><tbody>';

        foreach($emp_last5yrstay_details as $row) {
			echo '<tr name=row[] align="center">
			    	<td>'.date('d M Y', strtotime($row->from)).'</td>
			    	<td>'.date('d M Y', strtotime($row->to)).'</td>
			    	<td>'.$row->res_addr.'</td>
			    	<td>'.ucwords($row->dist_hq_name).'</td>
			    </tr>';
		}
        echo'</tbody>';
    $table->close();

    if($pending_emp_last5yrstay_details) {
    	$uiType = ($status == 'pending')? 'info':'danger';
	    echo '<div id = "pending_emp_last5yrstay_details"><h3 class="page-header" align="center">Last 5 Year Stay Details '.$ui->label()->uiType($uiType)->text(ucwords($status)).'</h3>';
	    $table = $ui->table()->responsive()->bordered()->striped()->open();
			echo '<thead><tr align="center">
						<td colspan=2 style="vertical-align:middle" ><b>Duration</b></td>
						<td rowspan=2 style="vertical-align:middle" ><b>Residential Address</b></td>
						<td rowspan=2 style="vertical-align:middle" ><b>Name of District Headquarters</b></td>
		        	</tr>
		        	<tr align="center">
		            	<td style="vertical-align:middle"><b>From</b></td>
		            	<td style="vertical-align:middle"><b>To</b></td>
		        	</tr></thead><tbody>';

            foreach($pending_emp_last5yrstay_details as $row) {
				echo '<tr name=row[] align="center">
				    	<td>'.date('d M Y', strtotime($row->from)).'</td>
				    	<td>'.date('d M Y', strtotime($row->to)).'</td>
				    	<td>'.$row->res_addr.'</td>
				    	<td>'.ucwords($row->dist_hq_name).'</td>
				    </tr>';
			}
	        echo'</tbody>';
        $table->close();
        echo '</div>';
    }
}
?>