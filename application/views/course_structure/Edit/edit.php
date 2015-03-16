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
		//if it is a common semester then show that also.
		if(isset($CS_session['group']))
		{
			$semester = $counter."_".$CS_session['group'];
			$box_form = $ui->box()->id("box_form_".$counter)->title("Semester ". $counter."( Group ".$CS_session['group'].")  (".$course_name.", ".$branch_name.")")->open();		
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
					  <th>Edit</th>
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
							$ui->input()->name("subjectid_".$semester."_".$i)->id($subjects["subject_details"][$semester][$i]->id)->value($subjects
							["subject_details"][$semester][$i]->subject_id)->disabled()->show();
						echo '
						</td>
						<td>';
							$ui->input()->name("subjectname_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->name)->disabled
							()->show();
						echo '
						</td>
						<td>';
							$ui->input()->name("subjectL_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->lecture)->disabled
							()->show();
						echo '
						</td>
						<td>';
							$ui->input()->name("subjectT_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->tutorial)->
							disabled()->show();
						echo '
						</td>
						<td>';
							$ui->input()->name("subjectP_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->practical)->
							disabled()->show();
						echo '
						</td>
						<td>';
							$ui->input()->name("subjectcredithours_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->
							credit_hours)->disabled()->show();
						echo '
						</td>
						<td>';
							$ui->input()->name("subjectcontacthours_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->
							contact_hours)->disabled()->show();
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
						<td>';	
							
							 $ui->button()
								->value('Edit')
								->uiType('primary')
								->id("editbutton_".$semester."_".$i)
								->icon($ui->icon("edit"))
								->extras(' onclick = EditSubject(\''.$semester.'\',\''.$i.'\') ')
								->name('edit')
								->show();
								
								$ui->button()
								->value('Save')
								->uiType('success')
								->id("savebutton_".$semester."_".$i)
								->icon($ui->icon("save"))
								->extras(' onclick = SaveSubject(\''.$semester.'\',\''.$i.'\') ')
								->name('save')
								->classes("savebutton")
								->show();
					echo '
						</td>		
					</tr>';
				}//inner for loop 
					   $aggr_id = $CS_session['aggr_id'];
						echo '
							<tr>
								<td>';
									 $ui->button()
										->value('Delete')
										->uiType('danger')
										->id("btndelete")
										->icon($ui->icon("remove"))
										->extras(' onclick = DeleteSemester(\''.$semester.'\',\''.$aggr_id.'\') ')
										->name('edit')
										->show();
						echo'
								</td>
							</tr>';
			$table->close();
			$box_form->close();	
		}
		//if CS for common is not selected then also show the CS in any case.
		else if(!isset($CS_session['group']) && ($counter == 1 || $counter == 2) && ($CS_session['duration'] == 1 || $CS_session['duration'] == 4 
		|| $CS_session['duration'] == 5))
		{
			for($comm_group = 1;$comm_group <=2;$comm_group++)
			{
				$semester = $counter."_".$comm_group;	
				//echo $semester;
				$box_form = $ui->box()->id("box_form_".$semester)->title("Semester ". $counter." (Group ".$comm_group.")(".$course_name.",  ".$branch_name.")")->open();
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
						  <th>Edit</th>
						</tr>';
					//echo $subjects['count'][$semester];	
					for($i=1;$i<=$subjects["count"][$semester];$i++)
					{
						echo '
						<tr>
							<td>';
								echo $subjects["sequence_no"][$semester][$i];
								echo '
							</td>
							<td>';
								$ui->input()->name("subjectid_".$semester."_".$i)->id($subjects["subject_details"][$semester][$i]->id)->value(
								$subjects["subject_details"][$semester][$i]->subject_id)->disabled()->show();
							echo '
							</td>
							<td>';
								$ui->input()->name("subjectname_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->name)->
								disabled()->show();
							echo '
							</td>
							<td>';
								$ui->input()->name("subjectL_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->lecture)->
								disabled()->show();
							echo '
							</td>
							<td>';
								$ui->input()->name("subjectT_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->tutorial)->
								disabled()->show();
							echo '
							</td>
							<td>';
								$ui->input()->name("subjectP_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->practical)->
								disabled()->show();
							echo '
							</td>
							<td>';
								$ui->input()->name("subjectcredithours_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->
								credit_hours)->disabled()->show();
							echo '
							</td>
							<td>';
								$ui->input()->name("subjectcontacthours_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->
								contact_hours)->disabled()->show();
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
							<td>';	
								
								 $ui->button()
									->value('Edit')
									->uiType('primary')
									->id("editbutton_".$semester."_".$i)
									->icon($ui->icon("edit"))
									->extras(' onclick = EditSubject(\''.$semester.'\',\''.$i.'\') ')
									->name('edit')
									->show();
									
									$ui->button()
									->value('Save')
									->uiType('success')
									->id("savebutton_".$semester."_".$i)
									->icon($ui->icon("save"))
									->extras(' onclick = SaveSubject(\''.$semester.'\',\''.$i.'\') ')
									->name('save')
									->classes("savebutton")
									->show();
						echo '
							</td>		
						</tr>';
					}//inner for loop 
						   $aggr_id = $CS_session['aggr_id'];
							echo '
								<tr>
									<td>';
										 $ui->button()
											->value('Delete')
											->uiType('danger')
											->id("btndelete")
											->icon($ui->icon("remove"))
											->extras(' onclick = DeleteSemester(\''.$semester.'\',\''.$aggr_id.'\') ')
											->name('edit')
											->show();
							echo'
									</td>
								</tr>';
				$table->close();			
				$box_form->close();
			}//for for common group closed.							
		}//else if(!isset($CS_session['group']) && ($counter == 1 || $counter == 2)) closed
		else if(!isset($CS_session['group']))
		{
			if($CS_session['course_id'] != "honour" && $CS_session['course_id'] != "minor")
			{ 
				$semester = $counter;
				$box_form = $ui->box()->id("box_form_".$semester)->title("Semester". $counter." ( ".$course_name.", ".$branch_name.")")->open();			
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
							  <th>Edit</th>
							</tr>';
							
	
						for($i=1;$i<=$subjects["count"][$semester];$i++)
						{
							if(isset($subjects["group_details"][$semester][$i]->group_id))
							{
							echo '
							<tr>
								<td colspan="11" align="center">';
									echo $subjects["group_details"][$semester][$i]->elective_name;
									$group_id = $subjects["group_details"][$semester][$i]->group_id;
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
									$ui->input()->name("subjectid_".$semester."_".$seq_no)->id($subjects["subject_details"][$semester][$i+$j]->id)->value(
									$subjects["subject_details"][$semester][$i+$j]->subject_id)->disabled()->show();
							echo '
								</td>
								<td>';
									$ui->input()->name("subjectname_".$semester."_".$seq_no)->value($subjects["subject_details"][$semester][$i+$j]->name)->disabled()->show();
							echo '
								</td>
								<td>';
									$ui->input()->name("subjectL_".$semester."_".$seq_no)->value($subjects["subject_details"][$semester][$i+$j]->lecture)->disabled()->show();
							echo '
								</td>
								<td>';
									$ui->input()->name("subjectT_".$semester."_".$seq_no)->value($subjects["subject_details"][$semester][$i+$j]->tutorial)->disabled()->show();
							echo '
								</td>
								<td>';
									$ui->input()->name("subjectP_".$semester."_".$seq_no)->value($subjects["subject_details"][$semester][$i+$j]->practical)->disabled()->show();
							echo '
								</td>
								<td>';
									$ui->input()->name("subjectcredithours_".$semester."_".$seq_no)->value($subjects["subject_details"][$semester][$i+$j]->credit_hours)->disabled()->show();
							echo '
								</td>
								<td>';
									$ui->input()->name("subjectcontacthours_".$semester."_".$seq_no)->value($subjects["subject_details"][$semester][$i+$j]->contact_hours)->disabled()->show();
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
								<td>';
									$seq_no = intval($i)+intval($j);
									$ui->button()
										->value('Edit')
										->uiType('primary')
										->id("editbutton_".$semester."_".$i)
										->icon($ui->icon("edit"))
										->extras(' onclick = EditSubject(\''.$semester.'\',\''.$i.'\') ')
										->name('edit')
										->show();
										
									$ui->button()
										->value('Save')
										->uiType('success')
										->id("savebutton_".$semester."_".$i)
										->icon($ui->icon("save"))
										->extras(' onclick = SaveSubject(\''.$semester.'\',\''.$i.'\') ')
										->name('save')
										->classes("savebutton")
										->show();
							echo '
								</td>		
							</tr>';	
							}//for closed..
							echo '<tr><td colspan = "11"></td></tr>';
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
									$ui->input()->name("subjectid_".$semester."_".$i)->id($subjects["subject_details"][$semester][$i]->id)->value(
									$subjects["subject_details"][$semester][$i]->subject_id)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectname_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->name)->
									disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectL_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->lecture)->
									disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectT_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->tutorial)->
									disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectP_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->practical)->
									disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectcredithours_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->
									credit_hours)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectcontacthours_".$semester."_".$i)->value($subjects["subject_details"][$semester][$i]->
									contact_hours)->disabled()->show();
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
								<td>';	
									
									 $ui->button()
										->value('Edit')
										->uiType('primary')
										->id("editbutton_".$semester."_".$i)
										->icon($ui->icon("edit"))
										->extras(' onclick = EditSubject(\''.$semester.'\',\''.$i.'\') ')
										->name('edit')
										->show();
										
										$ui->button()
											->value('Save')
											->uiType('success')
											->id("savebutton_".$semester."_".$i)
											->icon($ui->icon("save"))
											->extras(' onclick = SaveSubject(\''.$semester.'\',\''.$i.'\') ')
											->name('save')
											->classes("savebutton")
											->show();
							echo '
								</td>		
							</tr>';
						//}
							}//else closed
						}//inner for loop 
							   $aggr_id = $CS_session['aggr_id'];
								echo '
									<tr>
										<td>';
											 $ui->button()
												->value('Delete')
												->uiType('danger')
												->id("btndelete")
												->icon($ui->icon("remove"))
												->extras(' onclick = DeleteSemester(\''.$semester.'\',\''.$aggr_id.'\') ')
												->name('edit')
												->show();
								echo'
										</td>
									</tr>';
					$table->close();
				$box_form->close();
			}
			
			//show the honour subjects
			if(isset($subjects['honour']['subject_details']) && $counter >= 5 && $counter <= 8)
			{
				$semester = $counter;
			$box_form = $ui->box()->id("box_form_honour_".$counter)->title("Semester ". $counter. " (Honour)")->open();
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
					  <th>Edit</th>
					</tr>';
			
				$total_contact_hours = 0;
				$total_credit_hours = 0;
							
					for($i=1;$i<=$subjects['honour']["count"][$counter];$i++)
					{
						echo '
							<tr>
								<td>';
									echo $subjects['honour']["sequence_no"][$semester][$i];
									echo '
								</td>
								<td>';
									$ui->input()->name("subjectid_".$semester."_".$i)->id($subjects['honour']["subject_details"][$semester][$i]->id
									)->value($subjects['honour']["subject_details"][$semester][$i]->subject_id)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectname_".$semester."_".$i)->value($subjects['honour']["subject_details"][$semester][$i
									]->name)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectL_".$semester."_".$i)->value($subjects['honour']["subject_details"][$semester][$i]->
									lecture)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectT_".$semester."_".$i)->value($subjects['honour']["subject_details"][$semester][$i]->
									tutorial)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectP_".$semester."_".$i)->value($subjects['honour']["subject_details"][$semester][$i]->
									practical)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectcredithours_".$semester."_".$i)->value($subjects['honour']["subject_details"][
									$semester][$i]->credit_hours)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectcontacthours_".$semester."_".$i)->value($subjects['honour']["subject_details"][
									$semester][$i]->contact_hours)->disabled()->show();
								echo '
								</td>
								<td>';
								 
									  if($subjects['honour']["subject_details"][$semester][$i]->elective==0) 
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
							<td>';	
									 $ui->button()
										->value('Edit')
										->uiType('primary')
										->id("editbutton_".$semester."_".$i)
										->icon($ui->icon("edit"))
										->extras(' onclick = EditSubject(\''.$semester.'\',\''.$i.'\') ')
										->name('edit')
										->show();
										
										$ui->button()
											->value('Save')
											->uiType('success')
											->id("savebutton_".$semester."_".$i)
											->icon($ui->icon("save"))
											->extras(' onclick = SaveSubject(\''.$semester.'\',\''.$i.'\') ')
											->name('save')
											->classes("savebutton")
											->show();
							echo '
								</td>									
						</tr>';
					}	
					$aggr_id = $CS_session['aggr_id'];
					echo '
						<tr>
							<td>';
								 $ui->button()
									->value('Delete')
									->uiType('danger')
									->id("btndelete")
									->icon($ui->icon("remove"))
									->extras(' onclick = DeleteSemester(\''.$semester.'\',\''.$aggr_id.'\') ')
									->name('edit')
									->show();
					echo'
							</td>
						</tr>';
				$table->close();
			$box_form->close();
			}
			//show the minor subjects for the semester
			if(isset($subjects['minor']['subject_details']) && $counter >= 5 && $counter <= 8)
			{
				$semester = $counter;
				$box_form = $ui->box()->id("box_form_minor".$counter)->title("Semester ". $counter. " (Minor)")->open();
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
						  <th>Edit</th>
						</tr>';
								
				for($i=1;$i<=$subjects['minor']["count"][$counter];$i++)
				{
					echo '
							<tr>
								<td>';
									echo $subjects['minor']["sequence_no"][$semester][$i];
									echo '
								</td>
								<td>';
									$ui->input()->name("subjectid_".$semester."_".$i)->id($subjects['minor']["subject_details"][$semester][$i]->id
									)->value($subjects['minor']["subject_details"][$semester][$i]->subject_id)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectname_".$semester."_".$i)->value($subjects['minor']["subject_details"][$semester][$i
									]->name)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectL_".$semester."_".$i)->value($subjects['minor']["subject_details"][$semester][$i]->
									lecture)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectT_".$semester."_".$i)->value($subjects['minor']["subject_details"][$semester][$i]->
									tutorial)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectP_".$semester."_".$i)->value($subjects['minor']["subject_details"][$semester][$i]->
									practical)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectcredithours_".$semester."_".$i)->value($subjects['minor']["subject_details"][
									$semester][$i]->credit_hours)->disabled()->show();
								echo '
								</td>
								<td>';
									$ui->input()->name("subjectcontacthours_".$semester."_".$i)->value($subjects['minor']["subject_details"][
									$semester][$i]->contact_hours)->disabled()->show();
								echo '
								</td>
								<td>';
								 
									  if($subjects['minor']["subject_details"][$semester][$i]->elective==0) 
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
							<td>';			
							 $ui->button()
								->value('Edit')
								->uiType('primary')
								->id("editbutton_".$semester."_".$i)
								->icon($ui->icon("edit"))
								->extras(' onclick = EditSubject(\''.$semester.'\',\''.$i.'\') ')
								->name('edit')
								->show();
								
								$ui->button()
									->value('Save')
									->uiType('success')
									->id("savebutton_".$semester."_".$i)
									->icon($ui->icon("save"))
									->extras(' onclick = SaveSubject(\''.$semester.'\',\''.$i.'\') ')
									->name('save')
									->classes("savebutton")
									->show();
					echo '
						</td>							
					</tr>';
				}
				$aggr_id = $CS_session['aggr_id'];
				echo '
					<tr>
						<td>';
							 $ui->button()
								->value('Delete')
								->uiType('danger')
								->id("btndelete")
								->icon($ui->icon("remove"))
								->extras(' onclick = DeleteSemester(\''.$semester.'\',\''.$aggr_id.'\') ')
								->name('edit')
								->show();
				echo'
						</td>
					</tr>';
				$table->close();
			$box_form->close();
			}
		}
	}
