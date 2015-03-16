<?php
	$ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
			$column1 = $ui->col()->width(12)->t_width(12)->m_width(12)->open();
			
				$formbox =  $ui->box()->id('box_form')->open();
                    $form=$ui->form()->id("add_course_form")->action("course_structure/AddCS_Common/EnterNumberOfSubjects")->multipart()->open();
								
						$array_option = array();
						$array_option[0] = $ui->option()->value('""')->text("Select Semester")->disabled();
						$array_option[1] = $ui->option()->value("1")->text("Semester 1");
						$array_option[2] = $ui->option()->value("2")->text("Semester 2");
						
						$ui->select()
						->label('Select Semester')
						->required()
						->name('semester')
						->id("semester")
						->options($array_option)
						->containerId('cont_semester')
						->show();
						
						$array_option = array();
						$array_option[0] = $ui->option()->value('""')->text("Select Group")->disabled();
						$array_option[1] = $ui->option()->value("1")->text("Group 1(Physics)");
						$array_option[2] = $ui->option()->value("2")->text("Group 2(Chemistry)");
						
						$ui->select()
						->label('Select Group')
						->required()
						->name('group')
						->id("group")
						->options($array_option)
						->containerId('cont_group')
						->show();
						
						$array_option = array();
						array_push($array_option,$ui->option()->text("Starting From")->value('""')->disabled());
						$year = date("Y");
				//base_str = "<option selected = 'selected' disabled>Valid From</option>";
				
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