<?php
	$ui = new UI();
    $outer_row = $ui->row()->id('or')->open();
    $column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
    
    echo '<h3><b><center>Add details to your CV</b></center>';
    echo '2. Awards & Achievements</h3>';
    $formbox =  $ui->box()->id('box_form')->open();
                    $form=$ui->form()->id("add_course_form")->action("tnpcell/cv/save_achievements")->open();
    
    $table = $ui->table()->responsive()->hover()->bordered()->open();
    $category =array("Research Papers Published", "Academic Achievements", "Co-curricular Achievements","Position of Responsibility","Skill-Set");
							echo '
								  <tr>
									<th>Title</th>
                  <th>Details</th>
								  </tr>';
    for($i=1;$i<=5;$i++) {
              echo '
								  <tr> 
									<td width="30%">';
                  $ui->input()
											->placeholder($category[$i-1])
                      ->value($category[$i-1])
											->id('category'.$i)
											->name('category'.$i)
											->show();
              echo '
									</td>
									<td>';
                  $ui->textarea()
                      ->rows(7)
                      ->cols(60)
											->placeholder('Max 2000 characters')
											->id('information'.$i)
											->name('information'.$i)
											->show();
              echo '
									</td>
									</tr>  ';
		}
    $table->close();
    echo '<br><center>';
    $ui->button()
					->value('Save')
					->uiType('primary')
					->submit()
					->name('Submit')
					->show();
    $form->close();
		$formbox->close();
				
		$column1->close();
	$outer_row->close();
?>