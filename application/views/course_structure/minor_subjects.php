<?php
	$ui = new UI();
	//var_dump($subject_details);
	//die();
	
        $outer_row = $ui->row()->id('or')->open();
			$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			
				$formbox =  $ui->box()->id('box_form')->title("Minor Subjects For batch ".$batch." and Semester ".$semester."")->open();
                    $form=$ui->form()->id("add_course_form")->action("course_structure/honour_subjects/CreateMapping")->multipart()->open();
						$table = $ui->table()->responsive()->hover()->bordered()->open();						
							echo '
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
									
								foreach($subject_details as $row)
								{
										
								echo '
								<tr>
									<td>';
									//if it is already selected elective.
									if(isset($subject[$row->id]['selected']) && $subject[$row->id]['selected'])
									{
										$ui->checkbox()
											->name('checkbox[]')
											->checked()
											->value($row->id)
											->show();
									}
									else
									{
										$ui->checkbox()
											->name('checkbox[]')
											->value($row->id)
											->show();
									}
										
								echo '
									</td>
									<td>';
										echo $row->subject_id;
									echo '	
									</td>
									<td>';
										echo $row->name;
									echo '
									</td>
									<td>';
										echo $row->lecture;
									echo '
									</td>
									<td>';
										echo $row->tutorial;
									echo '
									</td>
									<td>';
										echo $row->practical;
									echo '
									</td>
									<td>';
										echo $row->credit_hours;
									echo '
									</td>
									<td>';
										echo $row->contact_hours;
									echo '
									</td>
								</tr>';	
								}
						
						echo '
							<tr>
								<td colspan = "8">';
									$ui->button()
										->value('Offer Minor')
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