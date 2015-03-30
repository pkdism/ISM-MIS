<?php
	echo "<h4>".$CS_session['course_name']." (".$CS_session['branch'].") for Session ".$CS_session['session']."</h4>";
	
$ui = new UI();
    $outer_row = $ui->row()->id('or')->open();
		$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			$formbox =  $ui->box()->id('box_form')->open();
                 $form=$ui->form()->action("course_structure/add/EnterSubjects")->multipart()->open();
				 	$ui->input()
						->placeholder('input text')
						->label('Core Subjects')
						->id('count_core')
						->name('count_core')
						->show();
					if(isset($CS_session['ele_count']) && $CS_session['ele_count'] == 0)
					{
						$ui->input()
						->placeholder('input text')
						->label('Elective Subjects')
						->id('count_elective')
						->name('count_elective')
						->value("0")
						->disabled()
						->show();
					}
					else
					{
						$ui->input()
						->placeholder('input text')
						->label('Elective Subjects')
						->id('count_elective')
						->name('count_elective')
						->show();	
					}
					
					
					$ui->button()
						->value('Proceed')
						->uiType('primary')
						->submit()
						->name('submit')
						->show();
		
				 $form->close();
			$formbox->close();
			
		$column1->close();
	$outer_row->close();
?>