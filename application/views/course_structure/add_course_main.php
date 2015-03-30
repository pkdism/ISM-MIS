<?php
 $ui = new UI();
    $outer_row = $ui->row()->id('or')->open();
		$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			$formbox =  $ui->box()->id('box_form')->open();
                 $form=$ui->form()->id("add_course_form")->action("course_structure/add_course_main/add")->multipart()->open();
				 	$ui->input()
						->placeholder('input text')
						->label('Course ID')
						->id('course_id')
						->name('course_id')
						->show();
						
					$ui->input()
						->placeholder('input text')
						->label('Course Name')
						->id('course_name')
						->name('course_name')
						->show();
						
						
						
					$ui->select()
						->label('Select Duration(In Years)')
						->name('course_duration')
						->id("duration_selection")
						->options(array($ui->option()->value('0')->text('Select Duration')->disabled()->selected(),
                                            $ui->option()->value('1')->text('1'),
                                            $ui->option()->value('2')->text('2'),
                                            $ui->option()->value('3')->text('3'),
                                            $ui->option()->value('4')->text('4'),
                                            $ui->option()->value('5')->text('5')))
						->show();
					
					
					$ui->button()
						->value('Add Course')
						->uiType('primary')
						->submit()
						->name('submit')
						->show();
		
				 $form->close();
			$formbox->close();
			
		$column1->close();
	$outer_row->close();
?>