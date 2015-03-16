<?php
 $ui = new UI();
    $outer_row = $ui->row()->id('or')->open();
		$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			$formbox =  $ui->box()->id('box_form')->open();
                 $form=$ui->form()->id("add_course_form")->action("course_structure/add_branch/add")->multipart()->open();
				 	$ui->input()
						->placeholder('input text')
						->label('Branch ID')
						->id('branch_id')
						->name('branch_id')
						->show();
						
					$ui->input()
						->placeholder('input text')
						->label('Branch Name')
						->id('branch_name')
						->name('branch_name')
						->show();
					
					$array_options = array();
						$array_options[0] = $ui->option()->value("0")->text("Select Department")->disabled()->selected();
						foreach ($result_dept as $row) 
							array_push($array_options,$ui->option()->value($row->id)->text($row->name));
										
							$ui->select()
								->label('Select Deparment')
								->name('dept')
								->id("dept_selection")
								->containerId("cont_dept_selection")
								->options($array_options)
								->show();
					
					$array_options = array();
						$array_options[0] = $ui->option()->value("0")->text("Select Course")->disabled()->selected();
						foreach ($result_course as $row) 
							array_push($array_options,$ui->option()->value($row->id)->text($row->name));
										
							$ui->select()
								->label('Select Course')
								->name('course')
								->id("course_selection1")
								->options($array_options)
								->show();
					
					$array_options = array();
						$array_options[0] = $ui->option()->value("0")->text("Starting Year")->disabled()->selected();
						for($counter=1926;$counter<=date('Y');$counter++) 
            			{
							$val = $counter."_".($counter+1);
							array_push($array_options,$ui->option()->value($val)->text($counter."-".($counter+1)));
						}
										
							$ui->select()
								->label('Starting Year')
								->name('year')
								->id("year_selection")
								->options($array_options)
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