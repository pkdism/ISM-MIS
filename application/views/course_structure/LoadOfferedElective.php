<?php
	$ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
			$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			
				$formbox =  $ui->box()->id('box_form')->title("Electives For batch ".$batch." and Semester ".$semester." are")->open();
                    $form=$ui->form()->id("add_course_form")->action("course_structure/elective_offered/CreateMapping")->multipart()->open();
						$table = $ui->table()->responsive()->hover()->bordered()->open();
							foreach($group_id as $key=>$val)
							{								
								echo '
									<tr align="center">
										<th colspan = "8" align="center">';
											echo $subject['elective_name'][$key];
								echo 
										'</th>
									</tr>
									<tr>
										<th>
											Select
										</th>
										<th>
											Subject ID
										</th>
										<th>
											Subject Name
										</th>
										<th>
											Lecture
										</th>
										<th>
											Tutorial
										</th>
										<th>
											Practical
										</th>
										<th>
											Credit Hours
										</th>
										<th>
											Contact Hours
										</th>
									</tr>';
										//echo $subject[$val]['count'];
										
										for($i = 0;$i<$subject[$val]['count'];$i++)
										{
									echo '
									<tr>
										<td>';
										//if it is already selected elective.
										if(isset($subject[$subject[$val]['id'][$i]]['selected']) && $subject[$subject[$val]['id'][$i]]['selected'])
										{
											$ui->checkbox()
												->name('checkbox[]')
												->checked()
												->value($subject[$val]['id'][$i])
												->show();
										}
										else
										{
											$ui->checkbox()
												->name('checkbox[]')
												->value($subject[$val]['id'][$i])
												->show();
										}
											
									echo '
										</td>
										<td>';
											echo $subject[$val]['subject_id'][$i];
										echo '	
										</td>
										<td>';
											echo $subject[$val]['subject_name'][$i];
										echo '
										</td>
										<td>';
											echo $subject[$val]['lecture'][$i];
										echo '
										</td>
										<td>';
											echo $subject[$val]['tutorial'][$i];
										echo '
										</td>
										<td>';
											echo $subject[$val]['practical'][$i];
										echo '
										</td>
										<td>';
											echo $subject[$val]['credit_hours'][$i];
										echo '
										</td>
										<td>';
											echo $subject[$val]['contact_hours'][$i];
										echo '
										</td>
									</tr>';	
										}
							}
						echo '
							<tr>
								<td colspan = "8">';
									$ui->button()
										->value('Select Elective')
										->uiType('primary')
										->submit()
										->name('submit')
										->show();
						echo '
								</td>
							</tr>';
						$table->close();
					$form->close();
				$formbox->close();
			$column1->close();
		$outer_row->close();

?>