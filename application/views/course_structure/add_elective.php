<?php
	echo "<h4>".$CS_session['course_name']." (".$CS_session['branch'].") for Session ".$CS_session['session']."</h4>";
	$ui = new UI();
    $outer_row = $ui->row()->id('or')->open();
		$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			$formbox =  $ui->box()->id('box_form')->open();
                 $form=$ui->form()->id("add_course_form")->action("course_structure/add/AddElectiveSubjects")->multipart()->open();
				 	$list_count = $CS_session['count_elective'];
					
					if($CS_session['list_type'] == 1)
					{
						$list_count = 1;
					}
					$no_of_elective = 1;
					for($counter = 1;$counter<=$list_count;$counter++)
					{ 
						
						if($options[$counter]>0)
						{
							echo '
								Enter details for Elective No'.$counter.' of Semester'.$CS_session['sem'];
							 $table = $ui->table()->responsive()->hover()->bordered()->open();
							 if($CS_session['list_type'] == 1)
							 {
								 for($no_of_elective = 1;$no_of_elective <= $CS_session['count_elective'];$no_of_elective++)
							 	 {
									echo '
									<tr>
										<td>Name of Elective '.$no_of_elective.'</td>
										<td>';
											$ui->input()->name("name_".$counter."_".$no_of_elective)->show();
									echo '
										</td>
									</tr>';	 
								 }
						     }
							 else
							 {
								echo '
								<tr>
									<td>Name of Elective '.$no_of_elective++.'</td>
									<td>';
										$ui->input()->name("name_".$counter)->show();
								echo '
									</td>
								</tr>';	 
								
							 }
							echo '		
								<tr>
									<td>L</td>
									<td>';
										$array_option = array();
										for($it=0;$it<=5;$it++)
											array_push($array_option,$ui->option()->value($it)->text($it));
										$ui->select()
										   ->name("L".$counter)
										   ->options($array_option)
										   ->show();
							echo '
									</td>
								</tr>
								<tr>
									<td>T</td>
									<td>';
										$array_option = array();
										for($it=0;$it<=5;$it++)
											array_push($array_option,$ui->option()->value($it)->text($it));
										$ui->select()
										   ->name("T".$counter)
										   ->options($array_option)
										   ->show();
							echo '
									</td>
								</tr>
								<tr>
									<td>P</td>
									<td>';
										$array_option = array();
										for($it=0;$it<=10;$it=$it+0.5)
											array_push($array_option,$ui->option()->value($it)->text($it));
										$ui->select()
										   ->name("P".$counter)
										   ->options($array_option)
										   ->show();
							echo '
									</td>
								</tr>
								<tr>
									<td>Credit Hours</td>
									<td>';
										$ui->input()->name("credit_hours".$counter)->placeholder("Credit Hours")->show();
							echo '
									</td>
								</tr>
								<tr>
									<td>Type</td>
									<td>';
										$array_option = array();
										array_push($array_option,$ui->option()->name("0")->text("Theory"));
										array_push($array_option,$ui->option()->name("1")->text("Practical"));
										array_push($array_option,$ui->option()->name("2")->text("Sessional"));
										array_push($array_option,$ui->option()->name("3")->text("Non-Contact"));
										
										$ui->select()
										   ->name("type".$counter)
										   ->options($array_option)
										   ->show();
							echo '
									</td>
								</tr>
								<tr>';
									$table_inner = $ui->table()->responsive()->hover()->bordered()->open();
										echo '
											<tr>
												<th>Sl.No.</th>
												<th>Subject ID</th>
												<th>Subject Name</th>		
											</tr>';
										for($i = 1;$i<=$options[$counter];$i++)
										{
											echo '
											<tr>
												<td>';
													$array_option = array();
													for($j = 1;$j<=$options[$counter];$j++)
														array_push($array_option,$ui->option()->value($j)->text($j));
													$ui->select()
													   ->name("sequence".$counter."_".$i)
													   ->id("sequence".$counter."_".$i)
													   ->options($array_option)
													   ->show();				
											echo '
												</td>
												<td>';
													$ui->input()->name("id".$counter."_".$i)->placeholder("Enter Subject ID")->show();
											echo '
												</td>
												<td>';
													$ui->input()->name("name".$counter."_".$i)->placeholder("Enter Subject Name")->show();
											echo '
												</td>
											</tr>';		
										}
									$table_inner->close();
							echo '	
								</tr>';	 
							 $table->close();	
						
						}
					}
					 $ui->button()
					->value('Add Elective Subjects')
					->uiType('primary')
					->submit()
					->name('submit')
					->show();			
					
					
				 $form->close();
			$formbox->close();
		$column1->close();
	$outer_row->close();
?>