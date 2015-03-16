<?php

    $ui = new UI();

        $form=$ui->form()
                 ->action('student/student_edit/update_education_details/'.$stu_id)
                 ->multipart()
                 ->id('form_submit')
                 ->open();

            $student_educational_details_row = $ui->row()
            									  ->open();

				$student_educational_details_box = $ui->box()
                                                      ->uiType('primary')
                                                      ->solid()
                                                      ->title('Edit Educational Details of Admission No. '.$stu_id)
                                                      ->open();

                    $ui->input()
                       ->type('hidden')
                       ->value($stu_type->auth_id)
                       ->id('student_type')
                       ->show();

                    $educational_details_row_1 = $ui->row()
                                                    ->open();

                    if($stu_education_details != FALSE)
					{

                        $table = $ui->table()
                                    ->responsive()
                                    ->id('tableid')
                                    ->hover()
                                    ->bordered()
                                    ->open();


                            echo '
                            <tr>
                                <th>S no.</th>
                                <th>Examination</th>
                                <th>Branch/Specialization</th>
                                <th>School/College/University/Institute</th>
                                <th>Year</th>
                                <th>Percentage/Grade</th>
                                <th>Class/Division</th>
                            </tr>';

                            $i=1;
							foreach($stu_education_details as $row)
							{
								$year_array = array();
	                            $year = 1926;
	                            $present_year = date('Y');
	                            while ($year <= $present_year)
	                            {
	                            	if($row->year == $year)
	                            		$year_array[] = $ui->option()->value($year)->text($year)->selected();
	                            	else
	                                	$year_array[] = $ui->option()->value($year)->text($year);
	                                $year_array = array_values($year_array);
	                                $year++;
	                            }

	                            $class_div_array = array();

	                            if($row->division=="first")
	                            	$class_div_array[] = $ui->option()->value('first')->text('FIRST')->selected();
	                            else
	                            	$class_div_array[] = $ui->option()->value('first')->text('FIRST');

	                            $class_div_array = array_values($class_div_array);

	                            if($row->division=="second") 
	                            	$class_div_array[] = $ui->option()->value('second')->text('SECOND')->selected();
	                            else
	                            	$class_div_array[] = $ui->option()->value('second')->text('SECOND');

	                            $class_div_array = array_values($class_div_array);

	                        	if($row->division=="third") 
	                            	$class_div_array[] = $ui->option()->value('third')->text('THIRD')->selected();
	                            else
	                            	$class_div_array[] = $ui->option()->value('third')->text('THIRD');

	                            $class_div_array = array_values($class_div_array);

	                        	if($row->division=="na") 
	                            	$class_div_array[] = $ui->option()->value('na')->text('NA')->selected();
	                            else
	                            	$class_div_array[] = $ui->option()->value('na')->text('NA');
								echo '
	                            <tr name="row[]" id="addrow" align="center">
	                                <td id="sno">'.$i.'</td>
	                                <td>';$ui->input()
	                                         ->name('exam4[]')
	                                         ->value(strtoupper($row->exam))
	                                         ->show();echo'</td>
	                                <td>';$ui->input()
	                                         ->name('branch4[]')
	                                         ->value(strtoupper($row->branch))
	                                         ->show();echo'</td>
	                                <td>';$ui->input()
	                                         ->name('clgname4[]')
	                                         ->value(strtoupper($row->institute))
	                                         ->show();echo'</td>
	                                <td>';$ui->select()
	                                         ->name('year4[]')
	                                         ->options($year_array)
	                                         ->show();echo'</td>
	                                <td>';$ui->input()
	                                         ->name('grade4[]')
	                                         ->value(strtoupper($row->grade))
	                                         ->show();echo'</td>
	                                <td>';$ui->select()
	                                         ->name('div4[]')
	                                         ->options($class_div_array)
	                                         ->show();echo'</td>
	                            </tr>';
	                            $i++;
	                        }

                        $table->close();
                    }

                    $educational_details_row_1->close();

                    $educational_details_row_2 = $ui->row()
                                                    ->open();

                        $educational_detail_col_1 = $ui->col()
                                                       ->width(5)
                                                       ->open();
                        $educational_detail_col_1->close();

                        $educational_detail_col_1 = $ui->col()
                                                       ->width(2)
                                                       ->open();

                            $ui->button()
                               ->block()
                               ->value('Add More')
                               ->id('add')
                               ->name('add')
                               ->show();

                        $educational_detail_col_1->close();

                    $educational_details_row_2->close();

                    $educational_details_row_2 = $ui->row()
                                          ->open();

                        $educational_details_2_1 = $ui->col()
                                                ->width(5)
                                                ->open();

                        $educational_details_2_1->close();

                        $ui->button()
                           ->submit(true)
                           ->value('Update')
                           ->uiType('primary')
                           ->width(2)
                           ->show();

            		$educational_details_row_2->close();

            		$educational_row_3 = $ui->row()
                                        	->open();

                        $educational_col_3_1 = $ui->col()
                                            	  ->width(11)
                                            	  ->open();

                        $educational_col_3_1->close();?>

                        <a href= <?= site_url('student/student_edit')?> ><?php

                        $ui->button()
                           ->value('Back')
                           ->width(1)
                           ->show();?></a><?php

                    $educational_row_3->close();

                $student_educational_details_box->close();

        	$student_educational_details_row->close();

        $form->close();

?>