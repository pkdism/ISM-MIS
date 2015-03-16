<?php
	$ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
			$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			
				$formbox =  $ui->box()->id('form_box')->open();
                    $form=$ui->form()->id("add_course_form")->action("course_structure/honour_subjects")->multipart()->open();
					
						
					$array_option = array();
					array_push($array_option,$ui->option()->value('""')->text("Select Batch")->disabled());
					array_push($array_option,$ui->option()->value($curr_session)->text($curr_session));
					array_push($array_option,$ui->option()->value($curr_session-1)->text($curr_session-1));
								
					$ui->select()
					->label('Batch')
					->name('session')
					->id("session_selection")
					->options($array_option)
					->required()
					->containerId('cont_session_selection')
					->show();
					
					
					$array_option = array();
					array_push($array_option,$ui->option()->value('""')->text("Select Semester")->disabled());
					for($i = 5;$i<=8;$i++)
						array_push($array_option,$ui->option()->value($i)->text($i));
					
					$ui->select()
					->label('Select Semester')
					->name('sem')
					->id("semester")
					->required()
					->options($array_option)	
					->containerId('cont_semester')
					->show();
				
				$ui->button()
					->value('Show Honour')
					->uiType('primary')
					->submit()
					->name('submit')
					->show();
						
					$form->close();
				$formbox->close();
			$column1->close();
		$outer_row->close();
?>		 