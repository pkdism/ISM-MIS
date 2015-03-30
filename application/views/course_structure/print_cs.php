<?php
	$course_name=$CS_session['course_name'];
    $course_duration=$CS_session['duration'];
    $branch_name=$CS_session['branch_name'];
    $aggr_id= $CS_session['aggr_id'];
    $session=$CS_session['session'];
	$start_semester = $CS_session['start_semester'];
	$end_semester = $CS_session['end_semester'];
	$ui = new UI();

    for($counter=$start_semester;$counter<=$end_semester;$counter++)
	{
		$total_credit_hours = 0;
		$total_contact_hours = 0;	
		//if it is a common semester then show that also.
		if(isset($CS_session['group']))
		{
			$semester = $counter."_".$CS_session['group'];
			$box_form = $ui->box()->id("box_form_".$counter)->title("Semester ". $counter."(group ".$CS_session['group'].") (".
			$course_name.", ".$branch_name.")")->open();		
				$table = $ui->table()->responsive()->hover()->bordered()->open();
				echo '
					<tr>
					  <th>Sl. No</th>
					  <th>Subject ID</th>
					  <th>Subject Name</th>
					  <th>Lecture</th>
					  <th>Tutorial</th>
					  <th>Practical</th>
					  <th>Credit Hours</th>
					  <th>Contact Hours</th>
					  <th>Elective</th>
					  <th>Type</th>
					</tr>';
					
				for($i=1;$i<=$subjects["count"][$semester];$i++)
				{					
					echo '
					<tr>
						<td>';
							echo $subjects["sequence_no"][$semester][$i];
							echo '
						</td>
						<td>';
							echo $subjects["subject_details"][$semester][$i]->subject_id;
						echo '
						</td>
						<td>';
							echo $subjects["subject_details"][$semester][$i]->name;
						echo '
						</td>
						<td>';
							echo $subjects["subject_details"][$semester][$i]->lecture;
						echo '
						</td>
						<td>';
							echo $subjects["subject_details"][$semester][$i]->tutorial;
						echo '
						</td>
						<td>';
							echo $subjects["subject_details"][$semester][$i]->practical;
						echo '
						</td>
						<td>';
							
							$total_credit_hours += intval($subjects["subject_details"][$semester][$i]->credit_hours);
							echo $subjects["subject_details"][$semester][$i]->credit_hours;
						echo '
						</td>
						<td>';
							$array_contact_hours = explode(".",$subjects["subject_details"][$semester][$i]->contact_hours);	
							if(count($array_contact_hours)>0)
								$total_contact_hours += floatval($subjects["subject_details"][$semester][$i]->contact_hours);
							else
								$total_contact_hours += intval($subjects["subject_details"][$semester][$i]->contact_hours);
							
							echo $subjects["subject_details"][$semester][$i]->contact_hours;
						echo '
						</td>
						<td>';
							  if($subjects["subject_details"][$semester][$i]->elective==0) 
								 echo "No";
							  else 
								echo "Yes";
					echo '
						</td>
						<td>';
						  if($subjects["subject_details"][$semester][$i]->type=="Theory") echo "Theory";
						  if($subjects["subject_details"][$semester][$i]->type=="Practical") echo "Practical";
						  if($subjects["subject_details"][$semester][$i]->type=="Sessional") echo "Sessional";
						  if($subjects["subject_details"][$semester][$i]->type =="Non-Contact") echo "Non-Contact";
					echo '
						</td>			
					</tr>';
				}//inner for loop 
				$aggr_id = $CS_session['aggr_id'];
				echo '
					<tr>
						<td colspan = "6" align ="center"><b>TOTAL</b></td><td> '.$total_credit_hours.'</td><td>'.$total_contact_hours.'</td><td
						scolspan="3"></td>
					</tr>';
			$table->close();
			$box_form->close();	
		}
		//if CS for common is not selected then also show the CS for Common in any case.
		else if(!isset($CS_session['group']) && ($counter == 1 || $counter == 2) && (($CS_session['duration'] == 1 || $CS_session['duration'] == 4 
		|| $CS_session['duration'] == 5)))
		{
			for($comm_group = 1;$comm_group <=2;$comm_group++)
			{
				$total_contact_hours = 0;
				$total_credit_hours = 0;
				$semester = $counter."_".$comm_group;	
				$box_form = $ui->box()->id("box_form_".$semester)->title("Semester ". $counter."(group ".$comm_group.") (".$course_name.", ".
				$branch_name.")")->open();
					$table = $ui->table()->responsive()->hover()->bordered()->open();
					echo '
						<tr>
						  <th>Sl. No</th>
						  <th>Subject ID</th>
						  <th>Subject Name</th>
						  <th>Lecture</th>
						  <th>Tutorial</th>
						  <th>Practical</th>
						  <th>Credit Hours</th>
						  <th>Contact Hours</th>
						  <th>Elective</th>
						  <th>Type</th>
						</tr>';
					for($i=1;$i<=$subjects["count"][$semester];$i++)
					{
						echo '
						<tr>
							<td>';
								echo $subjects["sequence_no"][$semester][$i];
								echo '
							</td>
							<td>';
								echo $subjects["subject_details"][$semester][$i]->subject_id;
							echo '
							</td>
							<td>';
								echo $subjects["subject_details"][$semester][$i]->name;
							echo '
							</td>
							<td>';
								echo $subjects["subject_details"][$semester][$i]->lecture;
							echo '
							</td>
							<td>';
								echo $subjects["subject_details"][$semester][$i]->tutorial;
							echo '
							</td>
							<td>';
								echo $subjects["subject_details"][$semester][$i]->practical;
							echo '
							</td>
							<td>';
								$total_credit_hours += intval($subjects["subject_details"][$semester][$i]->credit_hours);
								echo $subjects["subject_details"][$semester][$i]->credit_hours;
							echo '
							</td>
							<td>';
								$array_contact_hours = explode(".",$subjects["subject_details"][$semester][$i]->contact_hours);	
								if(count($array_contact_hours)>0)
									$total_contact_hours += floatval($subjects["subject_details"][$semester][$i]->contact_hours);
								else
									$total_contact_hours += intval($subjects["subject_details"][$semester][$i]->contact_hours);
								
								echo $subjects["subject_details"][$semester][$i]->contact_hours;
							echo '
							</td>
							<td>';
							 
								  if($subjects["subject_details"][$semester][$i]->elective==0) 
									 echo "No";
								  else 
									echo "Yes";
						echo '
							</td>
							<td>';
							  if($subjects["subject_details"][$semester][$i]->type=="Theory") echo "Theory";
							  if($subjects["subject_details"][$semester][$i]->type=="Practical") echo "Practical";
							  if($subjects["subject_details"][$semester][$i]->type=="Sessional") echo "Sessional";
							  if($subjects["subject_details"][$semester][$i]->type =="Non-Contact") echo "Non-Contact";
						echo '
							</td>			
						</tr>';
					}//inner for loop 
					$aggr_id = $CS_session['aggr_id'];
					echo '<tr><td colspan = "6" align ="center"><b>TOTAL</b></td><td> '.$total_credit_hours.'</td><td>'.$total_contact_hours.'</td>
					<td colspan="3"></td></tr>';	  
				$table->close();			
				$box_form->close();
			}//for for common group closed.							
		}//else if(!isset($CS_session['group']) && ($counter == 1 || $counter == 2)) closed
		//if it is not a common course or a minor or honour course..
		else if(!isset($CS_session['group']))
		{
			if($CS_session['course_id'] != "honour" && $CS_session['course_id'] != "minor")
			{ 
				$semester = $counter;
				$box_form = $ui->box()->id("box_form_".$semester)->title("Semester ". $counter." (".$course_name.", ".$branch_name.")")->open();			
				   
					$table = $ui->table()->responsive()->hover()->bordered()->open();
						echo '
							<tr>
							  <th>Sl. No</th>
							  <th>Subject ID</th>
							  <th>Subject Name</th>
							  <th>Lecture</th>
							  <th>Tutorial</th>
							  <th>Practical</th>
							  <th>Credit Hours</th>
							  <th>Contact Hours</th>
							  <th>Elective</th>
							  <th>Type</th>
							</tr>';
							
						for($i=1;$i<=$subjects["count"][$semester];$i++)
						{
							if(isset($subjects["group_details"]['group_id'][$semester][$i]))
							{
								//die("group id set");
								$group_id = $subjects["group_details"]['group_id'][$semester][$i];
							echo '
								<td colspan = "10" align = "center">';
									echo $subjects['group_details'][$group_id]->elective_name;	
							echo'
								</td>
							</tr>';
							for($j = 0;$j<$subjects["elective_count"][$group_id];$j++)
							{
								$seq_no = intval($i)+intval($j);
							echo 
							'<tr>
								<td>';
									echo $subjects["sequence_no"][$semester][$i+$j];
									echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i+$j]->subject_id;
							echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i+$j]->name;
							echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i+$j]->lecture;
							echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i+$j]->tutorial;
							echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i+$j]->practical;
							echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i+$j]->credit_hours;
							echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i+$j]->contact_hours;
							echo '
								</td>
								<td>';
									  if($subjects["subject_details"][$semester][$i+$j]->elective==0) 
										 echo "No";
									  else 
										echo "Yes";
							echo '
								</td>
								<td>';
								  if($subjects["subject_details"][$semester][$i+$j]->type=="Theory") echo "Theory";
								  if($subjects["subject_details"][$semester][$i+$j]->type=="Practical") echo "Practical";
								  if($subjects["subject_details"][$semester][$i+$j]->type=="Sessional") echo "Sessional";
								  if($subjects["subject_details"][$semester][$i+$j]->type =="Non-Contact") echo "Non-Contact";
							echo '
								</td>			
							</tr>';	
							}//for closed..
							echo '<tr><td colspan ="10"></td></tr>';
							$total_credit_hours += intval($subjects["subject_details"][$semester][$i+$j -1]->credit_hours); 
							
							$array_contact_hours = explode(".",$subjects["subject_details"][$semester][$i+$j -1]->contact_hours);	
							if(count($array_contact_hours)>0)
								$total_contact_hours += floatval($subjects["subject_details"][$semester][$i+$j -1]->contact_hours);
							else
								$total_contact_hours += intval($subjects["subject_details"][$semester][$i+$j -1]->contact_hours);
							
								$i = $j+$i-1;
							}//if closed.
							else
							{
							echo '
							<tr>
								<td>';
									echo $subjects["sequence_no"][$semester][$i];
									echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i]->subject_id;
								echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i]->name;
								echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i]->lecture;
								echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i]->tutorial;
								echo '
								</td>
								<td>';
									echo $subjects["subject_details"][$semester][$i]->practical;
								echo '
								</td>
								<td>';
									$total_credit_hours += intval($subjects["subject_details"][$semester][$i]->credit_hours); 
									echo $subjects["subject_details"][$semester][$i]->credit_hours;
								echo '
								</td>
								<td>';
								
									$array_contact_hours = explode(".",$subjects["subject_details"][$semester][$i]->contact_hours);	
									if(count($array_contact_hours)>0)
										$total_contact_hours += floatval($subjects["subject_details"][$semester][$i]->contact_hours);
									else
										$total_contact_hours += intval($subjects["subject_details"][$semester][$i]->contact_hours);
									
									//$total_contact_hours += intval($subjects["subject_details"][$semester][$i]->contact_hours);
									echo $subjects["subject_details"][$semester][$i]->contact_hours;
								echo '
								</td>
								<td>';
								 
									  if($subjects["subject_details"][$semester][$i]->elective==0) 
										 echo "No";
									  else 
										echo "Yes";
							echo '
								</td>
								<td>';
								  if($subjects["subject_details"][$semester][$i]->type=="Theory") echo "Theory";
								  if($subjects["subject_details"][$semester][$i]->type=="Practical") echo "Practical";
								  if($subjects["subject_details"][$semester][$i]->type=="Sessional") echo "Sessional";
								  if($subjects["subject_details"][$semester][$i]->type =="Non-Contact") echo "Non-Contact";
							echo '
								</td>									
							</tr>';
							}//else closed
						}//inner for loop 
						echo '
							<tr>
								<td colspan = "6" align ="center"><b>TOTAL</b></td><td> '.$total_credit_hours.'</td><td>'.$total_contact_hours.'
								</td><td colspan="3"></td>
							</tr>';
				$table->close();
			$box_form->close();
			}
			
			if(isset($subjects['honour']) && $counter >= 5 && $counter <= 8)
			{
			$box_form = $ui->box()->id("box_form_".$counter)->title("Semester ". $counter. " (Honour in ".$branch_name.")")->open();
				$table = $ui->table()->responsive()->hover()->bordered()->open();
				echo '
					<tr>
					  <th>Sl. No</th>
					  <th>Subject ID</th>
					  <th>Subject Name</th>
					  <th>Lecture</th>
					  <th>Tutorial</th>
					  <th>Practical</th>
					  <th>Credit Hours</th>
					  <th>Contact Hours</th>
					  <th>Elective</th>
					  <th>Type</th>
					</tr>';
			//show the honour subjects
			
				$total_contact_hours = 0;
				$total_credit_hours = 0;
							
					for($i=1;$i<=$subjects['honour']["count"][$counter];$i++)
					{
						echo '
						<tr>
							<td>';
								echo $subjects['honour']["sequence_no"][$counter][$i];
								echo '
							</td>
							<td>';
								echo $subjects['honour']["subject_details"][$counter][$i]->subject_id;
							echo '
							</td>
							<td>';
								echo $subjects['honour']["subject_details"][$counter][$i]->name;
							echo '
							</td>
							<td>';
								echo $subjects['honour']["subject_details"][$counter][$i]->lecture;
							echo '
							</td>
							<td>';
								echo $subjects['honour']["subject_details"][$counter][$i]->tutorial;
							echo '
							</td>
							<td>';
								echo $subjects['honour']["subject_details"][$counter][$i]->practical;
							echo '
							</td>
							<td>';
								$total_credit_hours += intval($subjects['honour']["subject_details"][$counter][$i]->credit_hours); 
								echo $subjects['honour']["subject_details"][$counter][$i]->credit_hours;
							echo '
							</td>
							<td>';
							
								$array_contact_hours = explode(".",$subjects['honour']["subject_details"][$counter][$i]->contact_hours);	
								if(count($array_contact_hours)>0)
									$total_contact_hours += floatval($subjects['honour']["subject_details"][$counter][$i]->contact_hours);
								else
									$total_contact_hours += intval($subjects['honour']["subject_details"][$counter][$i]->contact_hours);
								
								
								echo $subjects['honour']["subject_details"][$counter][$i]->contact_hours;
							echo '
							</td>
							<td>';
							 
								  if($subjects['honour']["subject_details"][$counter][$i]->elective==0) 
									 echo "No";
								  else 
									echo "Yes";
						echo '
							</td>
							<td>';
							  if($subjects['honour']["subject_details"][$counter][$i]->type=="Theory") echo "Theory";
							  if($subjects['honour']["subject_details"][$counter][$i]->type=="Practical") echo "Practical";
							  if($subjects['honour']["subject_details"][$counter][$i]->type=="Sessional") echo "Sessional";
							  if($subjects['honour']["subject_details"][$counter][$i]->type =="Non-Contact") echo "Non-Contact";
						echo '
							</td>									
						</tr>';
					}	
					echo '
					<tr>
						<td colspan = "6" align ="center"><b>TOTAL</b></td><td> '.$total_credit_hours.'</td><td>'.$total_contact_hours.'</td><td
						scolspan="3"></td>
					</tr>';
				$table->close();
			$box_form->close();
			}
			
			//show the minor subjects for the semester
			if(isset($subjects['minor']) && $counter >= 5 && $counter <= 8)
			{
				$total_contact_hours = 0;
				$total_credit_hours = 0;
				
				$box_form = $ui->box()->id("box_form_".$counter)->title("Semester ". $counter. " (Minor in ".$branch_name.")")->open();
					$table = $ui->table()->responsive()->hover()->bordered()->open();
					echo '
						<tr>
						  <th>Sl. No</th>
						  <th>Subject ID</th>
						  <th>Subject Name</th>
						  <th>Lecture</th>
						  <th>Tutorial</th>
						  <th>Practical</th>
						  <th>Credit Hours</th>
						  <th>Contact Hours</th>
						  <th>Elective</th>
						  <th>Type</th>
						</tr>';
								
				for($i=1;$i<=$subjects['minor']["count"][$counter];$i++)
				{
					echo '
					<tr>
						<td>';
							echo $subjects['minor']["sequence_no"][$counter][$i];
							echo '
						</td>
						<td>';
							echo $subjects['minor']["subject_details"][$counter][$i]->subject_id;
						echo '
						</td>
						<td>';
							echo $subjects['minor']["subject_details"][$counter][$i]->name;
						echo '
						</td>
						<td>';
							echo $subjects['minor']["subject_details"][$counter][$i]->lecture;
						echo '
						</td>
						<td>';
							echo $subjects['minor']["subject_details"][$counter][$i]->tutorial;
						echo '
						</td>
						<td>';
							echo $subjects['minor']["subject_details"][$counter][$i]->practical;
						echo '
						</td>
						<td>';
							$total_credit_hours += intval($subjects['minor']["subject_details"][$counter][$i]->credit_hours); 
							echo $subjects['minor']["subject_details"][$counter][$i]->credit_hours;
						echo '
						</td>
						<td>';
						
							$array_contact_hours = explode(".",$subjects['minor']["subject_details"][$counter][$i]->contact_hours);	
							if(count($array_contact_hours)>0)
								$total_contact_hours += floatval($subjects['minor']["subject_details"][$counter][$i]->contact_hours);
							else
								$total_contact_hours += intval($subjects['minor']["subject_details"][$counter][$i]->contact_hours);
							
							//$total_contact_hours += intval($subjects["subject_details"][$semester][$i]->contact_hours);
							echo $subjects['minor']["subject_details"][$counter][$i]->contact_hours;
						echo '
						</td>
						<td>';
						 
							  if($subjects['minor']["subject_details"][$counter][$i]->elective==0) 
								 echo "No";
							  else 
								echo "Yes";
					echo '
						</td>
						<td>';
						  if($subjects['minor']["subject_details"][$counter][$i]->type=="Theory") echo "Theory";
						  if($subjects['minor']["subject_details"][$counter][$i]->type=="Practical") echo "Practical";
						  if($subjects['minor']["subject_details"][$counter][$i]->type=="Sessional") echo "Sessional";
						  if($subjects['minor']["subject_details"][$counter][$i]->type =="Non-Contact") echo "Non-Contact";
					echo '
						</td>									
					</tr>';
				}
					echo '
						<tr>
							<td colspan = "6" align ="center"><b>TOTAL</b></td><td> '.$total_credit_hours.'</td><td>'.$total_contact_hours.'</td>
							<td colspan="3"></td>
						</tr>';
				$table->close();
			$box_form->close();
			}
		}	//last else if closed	
		
	}


			
		if(isset($syllabus_path))
		{
			echo '<a href = '.base_url($syllabus_path).'>Download Syllabus</a>';	
		}
			
  
?>	
