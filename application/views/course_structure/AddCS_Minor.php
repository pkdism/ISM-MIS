<?php
	$ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
			$column1 = $ui->col()->width(12)->t_width(12)->m_width(12)->open();
			
				$formbox =  $ui->box()->id('box_form')->open();
                    $form=$ui->form()->id("add_course_form")->action("course_structure/AddCS_Minor/EnterNumberOfSubjects")->multipart()->open();
						
						$array_options = array();
						$array_options[0] = $ui->option()->value("")->text("Select Department")->disabled();
						foreach ($result_dept as $row) 
							array_push($array_options,$ui->option()->value($row->id)->text($row->name));
						
						$ui->select()
							->label('Select Department')
							->name('dept')
							->id("dept_selection")
							->required()
							->options($array_options)
							->show();
						
						
						$array_options = array();
						$array_options[0] = $ui->option()->value("")->text("Select Semester")->disabled();
						for($i = 5;$i<=8;$i++) 
							array_push($array_options,$ui->option()->value($i)->text($i));
								
						
						$ui->select()
						->label('Select Semester')
						->required()
						->name('semester')
						->id("semester")
						->options($array_options)
						->containerId('cont_semester')
						->show();
						
						
						$array_option = array();
						array_push($array_option,$ui->option()->text("Starting From")->value('""')->disabled());
						$year = date("Y");
				
						for($d=$year-5;$d<=$year+5;$d++)
						{
							$session = $d."_".($d+1);
							array_push($array_option,$ui->option()->text($d."-".($d+1))->value($session));
						}
				
						
						$ui->select()
							->label('Valid From')
							->name('session')
							->id("session")
							->options($array_option)
							->containerId('cont_session')
							->show();
						
						$ui->button()
							->value('Add course Structure')
							->uiType('primary')
							->submit()
							->name('submit')
							->show();
					
					$form->close();
				$formbox->close();
			$column1->close();
		$outer_row->close();
?>		 