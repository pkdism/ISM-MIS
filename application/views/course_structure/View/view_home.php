<?php
	$ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
			$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			
				$formbox =  $ui->box()->id('box_form')->open();
                    $form=$ui->form()->id("add_course_form")->action("course_structure/view/ViewCourseStructure")->multipart()->open();
					
						$array_options = array();
						$array_options[0] = $ui->option()->value("")->text("Select Department")->disabled();
						foreach ($result_dept as $row) 
							array_push($array_options,$ui->option()->value($row->id)->text($row->name));
										
							$ui->select()
								->label('Select Department')
								->name('dept')
								->id("dept_selection")
								->options($array_options)
								->required()
								->show();
							
							
							$ui->select()
								->label('Select Course')
								->name('course')
								->id("course_selection")
								->required()
								->containerId('cont_course_selection')
								->show();
								
								$ui->select()
								->label('Select Branch')
								->name('branch')
								->id("branch_selection")
								->required()
								->containerId('cont_branch_selection')
								->show();
								
								$ui->select()
								->label('Valid From')
								->name('session')
								->id("session_selection")
								->required()
								->containerId('cont_session_selection')
								->show();
								
								$ui->select()
								->label('Select Semester')
								->name('sem')
								->id("semester")
								->required()
								->containerId('cont_semester')
								->show();
								
								$ui->select()
								->label('Select Group')
								->name('group')
								->id("group_selection")
								->containerId('cont_group')
								->show();
							
							$ui->button()
								->value('View course Structure')
								->uiType('primary')
								->submit()
								->name('submit')
								->show();
						
					$form->close();
				$formbox->close();
			$column1->close();
		$outer_row->close();
?>		 