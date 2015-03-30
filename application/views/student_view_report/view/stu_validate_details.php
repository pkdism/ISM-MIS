<?php $ui = new UI();
	  if(isset($user_details))
    {
       
          $tsex=$user_details->sex;
		  if($tsex=='m')
		  {
		  $tsex="Male";
		  }
		  else if($tsex=='f')
		  {
		  $tsex="Female";
		  }
		  else if($tsex=='o')
		  {
		  $tsex="Other";
		  }
		  
		   $deparment=$this->departments_model->getDepartmentById($user_details->dept_id)->name;
		  
			if(isset($this->student_typeugpg_model->getTypeById($student_details->type)->name))
			{
			$tstype=$this->student_typeugpg_model->getTypeById($student_details->type)->name;
			}
			else
			{
				$tstype=" ";
			}
			$tbgroup=$student_details->blood_group;
			
			if($tbgroup=='apos')
			{
			$tbgroup="A+";
			}
			elseif($tbgroup=='aneg')
			{
			$tbgroup="A-";
			}
			elseif($tbgroup=='bpos')
			{
			$tbgroup="B+";
			}
			elseif($tbgroup=='bneg')
			{
			$tbgroup="B-";
			}
			elseif($tbgroup=='opos')
			{
			$tbgroup="O+";
			}
			elseif($tbgroup=='oneg')
			{
			$tbgroup="O-";
			}
			elseif($tbgroup=='abpos')
			{
			$tbgroup="AB+";
			}
			elseif($tbgroup=='abneg')
			{
			$tbgroup="AB-";
			}
			
			//--------------middle name-----
			$mname=$user_details->middle_name;
			
			if($mname=="Na")
			{
				$mname="";
			}
			else
			{
				$mname=$user_details->middle_name;
			}
			//-------------------------------
			   
	   $ui = new UI();
	     $stuRowpdetails = $ui->row()->open();
			$col1 = $ui->col()->width(12)->open();
				$box = $ui->box()
					  ->title('Personal Details')
					  ->solid()	
					  ->uiType('primary')
					  ->open();
                    
					
					
						$stuRow2 = $ui->row()->open();
						
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Name</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo ucwords(trim($user_details->first_name)).' '.ucwords($mname).' '.ucwords(trim($user_details->last_name));
							$col2->close();
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Name in Hindi</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo $student_details->name_in_hindi;
							$col4->close();
							
							
							
						$stuRow2->close();
						
						
						
						$stuRowgen = $ui->row()->open();
						
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Gender</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo $tsex;
							$col2->close();
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Date of Birth</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo date('d M Y', strtotime($user_details->dob));
							$col4->close();
							
							
						$stuRowgen->close();
						
						$stuRowdob = $ui->row()->open();
						
							
							
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Place of Birth</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo ucwords($user_other_details->birth_place);
							$col2->close();
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Physically Challenged</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo ucwords($user_details->physically_challenged);
							$col4->close();
							
						$stuRowdob->close();
						
						$stuRowkm = $ui->row()->open();
						
													
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Blood Group</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo ucwords($tbgroup);
							$col4->close();
							
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Kashmiri Immigrant</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo ucwords($user_other_details->kashmiri_immigrant);
							$col2->close();
							
						$stuRowkm->close();
						
						
						
						$stuRowmstatus = $ui->row()->open();
						
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Marital Status</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo ucwords($user_details->marital_status);
							$col4->close();
							
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Category</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo ucwords($user_details->category);
							$col2->close();
							
							
						$stuRowmstatus->close();
						
						$stuRowcategory = $ui->row()->open();
						
							
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Religion</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo ucwords($user_other_details->religion);
							$col4->close();
							
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Nationality</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo ucwords($user_other_details->nationality);
							$col2->close();
						$stuRowcategory->close();
						
						
						
						$stuRowadhar = $ui->row()->open();
						
							$col1 = $ui->col()->width(3)->open();
								echo "<label>AADHAR Card No</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo $stu_other_details->aadhaar_card_no;
							$col2->close();
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Identification Mark</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo ucwords($student_details->identification_mark);
							$col4->close();
							
						$stuRowadhar->close();
						
					$box->close();
						
						
						
						
						
						
						
						
						$boxfdetail = $ui->box()
							  ->title('Family Details')
							  ->solid()	
							  ->uiType('primary')
							  ->open();
					  
							  $stuRow4 = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Father Name</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo $user_other_details->father_name;
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Mother Name</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
										echo $user_other_details->mother_name;
									$col4->close();
									
								$stuRow4->close();
								
								$stuRow5 = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Father Occupation</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo $stu_other_details->fathers_occupation;
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Mother Occupation</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
										echo $stu_other_details->mothers_occupation;
									$col4->close();
									
								$stuRow5->close();
								
								$stuRow6 = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Father Gross Annual Income</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo $stu_other_details->fathers_annual_income;
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Mother Gross Annual Income</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
										echo $stu_other_details->mothers_annual_income;
									$col4->close();
									
								$stuRow6->close();
								
								$stuRow7 = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Guardian Name</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo strtoupper($stu_other_details->guardian_name);
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Guardian Relation</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
										echo strtoupper($stu_other_details->guardian_relation);
									$col4->close();
									
								$stuRow7->close();
								$stuRow8 = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Parent/Guardian Mobile No</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo $student_details->parent_mobile_no;
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Parent/Guardian Landline No</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
										if($student_details->parent_landline_no != '0')
											echo $student_details->parent_landline_no;
										else
											echo '';
									$col4->close();
									
								$stuRow8->close();
					  
					  
					  $boxfdetail->close();
				
						// Student Address
						$boxaddress = $ui->box()
							  ->title('Address Details')
							  ->solid()	
							  ->uiType('primary')
							  ->open();
					  
							  $stuRowPresent  = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Present Address</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo ucwords($present_address->line1).',<br>'.(($present_address->line2=='')? '':ucwords($present_address->line2).',<br>')
										.ucwords($present_address->city).', '.ucwords($present_address->state).' - '.$present_address->pincode.'<br>'
										.ucwords($present_address->country).'<br>
										Contact no. '.$present_address->contact_no;
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Permanent Address</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
									echo ucwords($permanent_address->line1).',<br>'.(($permanent_address->line2=='')? '':ucwords($permanent_address->line2).',<br>')
										.ucwords($permanent_address->city).', '.ucwords($permanent_address->state).' - '.$permanent_address->pincode.'<br>'
										.ucwords($permanent_address->country).'<br>
										Contact no. '.$permanent_address->contact_no;
									$col4->close();
									
								$stuRowPresent->close();
								if($cross_address)
								{
								$stuRowcorrespondence  = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Crosspondence Address</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo ucwords($cross_address->line1).',<br>'.(($cross_address->line2=='')? '':ucwords($cross_address->line2).',<br>')
										.ucwords($cross_address->city).', '.ucwords($cross_address->state).' - '.$cross_address->pincode.'<br>'
										.ucwords($cross_address->country).'<br>
										Contact no. '.$cross_address->contact_no;
									$col2->close();
								
								$stuRowcorrespondence->close();
								}
					  
						$boxaddress ->close();
						// Address End
						
//*********************************Educational Detail****************************	
//*************Education Detail*******
						
						$boxeducationdetail = $ui->box()
							  ->title('Educational Details')
							  ->solid()	
							  ->uiType('primary')
							  ->open();
							  
							  $stuRowexamheading = $ui->row()->open();
								
									$col1 = $ui->col()->width(2)->open();
										echo "<label>Examination</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(2)->open();
										echo "<label>Course/<br>Specialization</label>";
									$col2->close();
									
									$col3 = $ui->col()->width(2)->open();
										echo "<label>College/University/<br>Institute</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(2)->open();
									echo "<label>Year</label>";
									$col4->close();
									
									$col5 = $ui->col()->width(2)->open();
									echo "<label>Percentage/<br>Grade</label>";
									$col5->close();
									
									$col6 = $ui->col()->width(2)->open();
									echo "<label>Class/<br>Division</label>";
									$col6->close();
									
									
								$stuRowexamheading->close();
								
								$stuRowexamloop = $ui->row()->open();
								foreach($stu_education_details as $row)
								{
									$col1 = $ui->col()->width(2)->open();
										echo strtoupper($row->exam);
									$col1->close();
									
									$col2 = $ui->col()->width(2)->open();
										echo strtoupper($row->branch);
									$col2->close();
									
									$col3 = $ui->col()->width(2)->open();
										echo strtoupper($row->institute);
									$col3->close();
									
									$col4 = $ui->col()->width(2)->open();
									echo $row->year;
									$col4->close();
									
									$col5 = $ui->col()->width(2)->open();
									echo strtoupper($row->grade);
									$col5->close();
									
									$col6 = $ui->col()->width(2)->open();
									echo ucwords($row->division);
									$col6->close();
								}
								$stuRowexamloop->close();
							  
							  
						$boxeducationdetail->close();  
						//************************************					
//********************************************************************************						
						
//***********************Admission Starts*****************************
		$boxentrancedetail = $ui->box()
							  ->title('Admission Details')
							  ->solid()	
							  ->uiType('primary')
							  ->open();
							  
						$stuRowMigration = $ui->row()->open();
						
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Migration Certificate</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo ucwords($student_details->migration_cert);
							$col2->close();
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Roll No</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo strtoupper($student_details->enrollment_no);
							$col4->close();
							
							
						$stuRowMigration->close();
						
						$stuRowentrance = $ui->row()->open();
						
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Date of Admission</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo date('d M Y', strtotime($student_details->admn_date));
							$col2->close();
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Admission Based On</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo strtoupper($student_academic->admn_based_on);
							$col4->close();
							
						$stuRowentrance->close();
						
												
						$stuRowentrance1 = $ui->row()->open();
						
							$col1 = $ui->col()->width(3)->open();
								echo "<label>IIT JEE General Rank</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo $student_academic->iit_jee_rank;
							$col2->close();
														
							$col3 = $ui->col()->width(3)->open();
								echo "<label>IIT JEE Category Rank</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo $student_academic->iit_jee_cat_rank;
							$col4->close();
						$stuRowentrance1->close();
						
						$stuRowentrance2 = $ui->row()->open();
						
							$col1 = $ui->col()->width(3)->open();
								echo "<label>GATE Score</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo $student_academic->gate_score;
							$col2->close();
														
							$col3 = $ui->col()->width(3)->open();
								echo "<label>CAT Score</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo $student_academic->cat_score;
							$col4->close();
						$stuRowentrance2->close();
						$stuRowstudenttype = $ui->row()->open();
						
							
							
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Student Type</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo ucwords($tstype);
							$col2->close();
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Present Semester</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								if($student_academic->semester != '-1')
									echo $student_academic->semester;
								else
									echo 'NA';
							$col4->close();
							
							
							
						$stuRowstudenttype->close();
						$stuRowdept= $ui->row()->open();
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Department</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo $deparment;
							$col2->close();
							
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Course</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								if($student_academic->course_id = 'na')
									echo 'NA';
								else
									echo $student_academic->course_id;
							$col4->close();
						$stuRowdept->close();
						
					$stuRowcourse = $ui->row()->open();
							
							
							
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Branch</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								if($student_academic->branch_id == 'na')
									echo 'NA';
								else
									echo $student_academic->branch_id;
							$col4->close();
							
						$stuRowcourse->close();
						
							  
						$boxentrancedetail->close();
						
	
//***********************Admission Details End*******************************
						
//***********************Bank Details Starts*****************************

	$boxbankdetail = $ui->box()
							  ->title('Bank Details')
							  ->solid()	
							  ->uiType('primary')
							  ->open();
					  
							  
								
									$stuRowBank = $ui->row()->open();
						
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Bank Name</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo $stu_other_details->bank_name;
							$col2->close();
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Account No.</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo $stu_other_details->account_no;
							$col4->close();
							
						$stuRowBank->close();
					  
						$boxbankdetail ->close();
//***********************Bank Details End*******************************
//***********************Fee Detail Starts*****************************
	  
					  $boxfeedetail = $ui->box()
							  ->title('Details of Fees Payment at the time of Admission')
							  ->solid()	
							  ->uiType('primary')
							  ->open();
					  
							  $stuRowpayment = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Mode of Payment</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo ucwords($student_fee_details->fee_mode);
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Fee Pay Date</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
									echo date('d M Y', strtotime($student_fee_details->payment_made_on));
									$col4->close();
									
								$stuRowpayment->close();
								$stuRowdd = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>DD/Cheque No.</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo $student_fee_details->transaction_id;
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Fee Paid Amount</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
										if($student_fee_details->fee_amount == '0')
											echo '';
										else
											echo $student_fee_details->fee_amount;
									$col4->close();
									
								$stuRowdd->close();
								
					  
						$boxfeedetail ->close();
//*************************************Fee Detail ENDS********
					
						
						//*** Editable details*****
						
						$boxotherdetail = $ui->box()
							  ->title('Editable Details')
							  ->solid()	
							  ->uiType('primary')
							  ->open();
					  
							  $stuRowemail = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Email ID</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo $user_details->email;
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Alternate Email</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
									echo $student_details->alternate_email_id;
									$col4->close();
									
								$stuRowemail->close();
								$stuRowmobile = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Mobile No</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo $user_other_details->mobile_no;
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Alternate Mobile No</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
										if($student_details->alternate_mobile_no != '0')
											echo $student_details->alternate_mobile_no;
										else
											echo '';
									$col4->close();
									
								$stuRowmobile->close();
								
								$stuRowHobbies = $ui->row()->open();
								
									$col1 = $ui->col()->width(3)->open();
										echo "<label>Hobbies</label>";
									$col1->close();
									
									$col2 = $ui->col()->width(3)->open();
										echo ucwords($user_other_details->hobbies);
									$col2->close();
									
									$col3 = $ui->col()->width(3)->open();
										echo "<label>Favourite Pass Time</label>";
									$col3->close();
									
									$col4 = $ui->col()->width(3)->open();
									echo ucwords($user_other_details->fav_past_time);
									$col4->close();
									
								$stuRowHobbies->close();
								$stuRowExtraActivity = $ui->row()->open();
						
							$col1 = $ui->col()->width(3)->open();
								echo "<label>Extra-Curricular Activities</label>";
							$col1->close();
							
							$col2 = $ui->col()->width(3)->open();
								echo ucwords($stu_other_details->extra_curricular_activity);
							$col2->close();
							
							$col3 = $ui->col()->width(3)->open();
								echo "<label>Any Other Relevant Information</label>";
							$col3->close();
							
							$col4 = $ui->col()->width(3)->open();
								echo ucwords($stu_other_details->other_relevant_info);
							$col4->close();
							
						$stuRowExtraActivity->close();
													
					  
						$boxotherdetail ->close();

					$form1=$ui->form()
			                 ->action('student/student_validate/insert_approved_details/'.$admn_no)
			                 ->multipart()
			                 ->id('form_submit')
			                 ->open();
						echo '<center>';
							$ui->button()->submit()->flat()->id('approve')->name('approve')->icon($ui->icon('thumbs-up'))->value('Approve')->uiType('success')->show();
							$ui->button()->flat()->id('b_reject')->name('b_reject')->icon($ui->icon('thumbs-down'))->value('Reject')->uiType('danger')->show();
						echo '</center>';
					$form1->close();

					$form2=$ui->form()
			                 ->action('student/student_validate/details_rejected/'.$admn_no)
			                 ->multipart()
			                 ->id('form_submit')
			                 ->open();

						echo "<div id='reason_cover' style='display:none' >";
							$col=$ui->col()->width(3)->t_width(3)->m_width(3)->open();$col->close();
							$ui->input()->id('reason')->width(6)->t_width(6)->m_width(6)->name('reason')->placeholder('Reason for Rejection')->addonRight($ui->button()->submit()->icon($ui->icon('thumbs-down'))->uiType('danger')->name('reject')->value('Reject'))->show();
						echo "</div>";
					$form2->close();
	}
    else
    {
    	echo '<center><h2>Student Basic Details</h2>';
    	$this->notification->drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
    }
?>
