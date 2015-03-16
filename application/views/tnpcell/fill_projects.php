<?php
	$ui = new UI();
    $outer_row = $ui->row()->id('or')->open();
    $column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
    
    echo '<h3><b><center>Add details to your CV</b></center>';
    echo '1. Project/Internship/Excursion/Training</h3>';
    $formbox =  $ui->box()->id('box_form')->open();
                    $form=$ui->form()->id("add_course_form")->action("tnpcell/cv/save_projects")->open();
    
    $table = $ui->table()->responsive()->hover()->bordered()->open();
							echo '
								  <tr>
									<th>Sl.No</th>
                  <th>Details</th>
								  </tr>';
    for($counter=1;$counter<=5;$counter++) {
              echo '
								  <tr> 
									<td>';
                  echo $counter;
              echo '
									</td>
									<td>';
                  $ui->input()
											->placeholder('Place')
											->id('place'.$counter)
											->name('place'.$counter)
											->show();

                  $ui->input()
											->placeholder('Title')
											->id('title'.$counter)
											->name('title'.$counter)
											->show();
              
                  $ui->input()
											->placeholder('Duration (in weeks)')
											->id('duration'.$counter)
											->name('duration'.$counter)
											->show();
              
                  $ui->input()
											->placeholder('Role')
											->id('role'.$counter)
											->name('role'.$counter)
											->show();
              
                  $ui->textarea()
											->placeholder('Description')
											->id('description'.$counter)
											->name('description'.$counter)
											->show();
              echo '
									</td>
									</tr>  ';
		}
    $table->close();
    echo '<br><center>';
    $ui->button()
					->value('Next')
					->uiType('primary')
					->submit()
					->name('Submit')
					->show();
    $form->close();
			$formbox->close();
				
		$column1->close();
	$outer_row->close();
?>