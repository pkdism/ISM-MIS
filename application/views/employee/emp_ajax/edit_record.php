<?php $ui = new UI();
	switch($form)
	{
		case 2: if($emp_prev_exp_details)
				{
					$form = $ui->form()->id('edit_prev_emp_details')->action('employee/edit/update_old_prev_emp_details/'.$sno)->extras('onSubmit="return onclick_save('.$sno.');"')->open();
						$row = $ui->row()->open();
							$col = $ui->col()->open();
								$box = $ui->box()->uiType('primary')->style('margin-bottom:0')->open();
									$ui->textarea()->label('Full address of Employer')->name('edit_addr'.$sno)->id('edit_addr'.$sno)->value($emp_prev_exp_details->address)->show();
									$ui->input()->label('Position Held')->name('edit_designation'.$sno)
										->id('edit_designation'.$sno)->value($emp_prev_exp_details->designation)
										->show();
									$ui->datePicker()->name('edit_from'.$sno)->id('edit_from'.$sno)
		                                    ->dateFormat('dd-mm-yyyy')->addonRight($ui->icon("calendar"))
		                                    ->label('From')
		                                    ->extras('max="'.date('d-m-Y',strtotime($joining_date)).'"')
		                                    ->value(date('d-m-Y',strtotime($emp_prev_exp_details->from)))
		                                    ->show();
                    				$ui->datePicker()->name('edit_to'.$sno)->id('edit_to'.$sno)
		                                    ->dateFormat('dd-mm-yyyy')
		                                    ->addonRight($ui->icon("calendar"))
		                                    ->label('To')
		                                    ->extras('max="'.date('d-m-Y',strtotime($joining_date)).'"') //max not working
		                                    ->value(date('d-m-Y',strtotime($emp_prev_exp_details->to)))->show();
                                 	$ui->input()->name("edit_payscale".$sno)->id("edit_payscale".$sno)
                                 	        ->label('Pay Scale')->value($emp_prev_exp_details->pay_scale)->show();
									$ui->input()->name('edit_reason'.$sno)->id('edit_reason'.$sno)
											->value($emp_prev_exp_details->remarks)->label('Remarks')->show();
										echo '<center>';
										$ui->button()->uiType('primary')->flat()->submit()
											->name('save')->value('Save')->icon($ui->icon('floppy-o'))->show();
										$ui->button()->uiType('danger')->flat()
											->name('cancel')->value('Cancel')
											->extras('onClick="closeframe();"')->icon($ui->icon('times'))->show();
										echo '</center>';
								$box->close();
							$col->close();
						$row->close();
					$form->close();
				}
				break;

		case 3: if($emp_family_details)
				{
					$form = $ui->form()->id('edit_emp_family_details')->multipart()
					->action('employee/edit/update_old_fam_details/'.$sno)
					->extras('onSubmit="return onclick_save('.$sno.');"')->open();
						$row = $ui->row()->open();
							$col = $ui->col()->open();
								$box = $ui->box()->uiType('primary')->style('margin-bottom:0')->open();

									$ui->input()->name('edit_name'.$sno)->id('edit_name'.$sno)->label('Name')
									    ->value($emp_family_details->name)->disabled()->show();

                    				$ui->select()->name('edit_relationship'.$sno)->id('edit_relationship'.$sno)->label('Relationship')->disabled()
                                       ->options(array($ui->option()->value("")->text("Choose One")->disabled(),
                                    					$ui->option()->value("Father")->text("Father")
                                    					   ->selected($emp_family_details->relationship=="Father"),
                                    					$ui->option()->value("Mother")->text("Mother")
                                    					   ->selected($emp_family_details->relationship=="Mother"),
                                    					$ui->option()->value("Spouse")->text("Spouse")
                                    					   ->selected($emp_family_details->relationship=="Spouse"),
                                    					$ui->option()->value("Son")->text("Son")
                                    					   ->selected($emp_family_details->relationship=="Son"),
                                    					$ui->option()->value("Daughter")->text("Daughter")
                                    					   ->selected($emp_family_details->relationship=="Daughter")))
                                       ->show();
                                $inrow = $ui->row()->open();
                    				$ui->datePicker()->name('edit_dob'.$sno)
                    					->id('edit_dob'.$sno)
	                                    ->dateFormat('dd-mm-yyyy')
	                                    ->width(4)->t_width(4)
	                                    ->addonRight($ui->icon("calendar"))
	                                    ->value(date('d-m-Y',strtotime($emp_family_details->dob)))
	                                    ->label('DOB')->show();

									$ui->input()->name("edit_profession".$sno)
										        ->id("edit_profession".$sno)
										        ->width(4)->t_width(4)
										        ->label('Profession')
										        ->value($emp_family_details->profession)->show();

                    				$status = $ui->input()->name('edit_active'.$sno)
                    					        ->id('edit_active'.$sno)
                    					        ->width(4)->t_width(4)
                    					        ->label('Active/Inactive')
                    					        ->value($emp_family_details->active_inactive);

                    				if($emp_family_details->active_inactive == 'Active')
                                        $status->addonRight($ui->button()->icon($ui->icon('check')->id('icon'))->id('edit_status_toggle')->uiType('success'));
                                    else
                                    	$status->addonRight($ui->button()->icon($ui->icon('times')->id('icon'))->id('edit_status_toggle')->uiType('danger'));
                                    $status->extras('readonly')->width(3)->t_width(3)->show();
								$inrow->close();

                    				$ui->input()->name("edit_address".$sno)->id("edit_address".$sno)
                    					->value($emp_family_details->present_post_addr)
                    					->label('Present Postal Address')->show();

                    				$ui->imagePicker()->label("Photograph")->containerId('edit_photo_container'.$sno)->id('edit_photo'.$sno)->name('edit_photo'.$sno)->show();

									echo '<center>';
									$ui->button()->uiType('primary')->flat()->submit()
										->name('save')->value('Save')->icon($ui->icon('floppy-o'))->show();
									$ui->button()->uiType('danger')->flat()
										->name('cancel')->value('Cancel')
										->extras('onClick="closeframe();"')->icon($ui->icon('times'))->show();
									echo '</center>';
								$box->close();
							$col->close();
						$row->close();
					$form->close();
				}
				break;

		case 4:	if($emp_education_details)
				{
					$form = $ui->form()->id('edit_emp_education_details')
					->action('employee/edit/update_old_education_details/'.$sno)
					->extras('onSubmit="return onclick_save('.$sno.');"')->open();
						$row = $ui->row()->open();
							$col = $ui->col()->open();
								$box = $ui->box()->uiType('primary')->style('margin-bottom:0')->open();
									$row11 = $ui->row()->open();
										$ui->select()->id('edit_exam'.$sno)->name('edit_exam'.$sno)->label('Examination')->width(4)->t_width(4)->extras('onChange="examination_editbtn_handler('.$sno.');"')
	                                       ->options(array($ui->option()->value("")->text("Choose One")->disabled(),
	                                                		$ui->option()->value("non-matric")->text("Non-Matric")->selected($emp_education_details->exam == "non-matric"),
			                                                $ui->option()->value("matric")->text("Matric")->selected($emp_education_details->exam == "matric"),
				                                            $ui->option()->value("intermediate")->text("Intermediate")->selected($emp_education_details->exam == "intermediate"),
			                                                $ui->option()->value("graduation")->text("Graduation")->selected($emp_education_details->exam == "graduation"),
			                                                $ui->option()->value("post-graduation")->text("Post Graduation")->selected($emp_education_details->exam == "post-graduation"),
			                                                $ui->option()->value("doctorate")->text("Doctorate")->selected($emp_education_details->exam == "doctorate"),
			                                                $ui->option()->value("post-doctorate")->text("Post Doctorate")->selected($emp_education_details->exam == "post-doctorate"),
			                                                $ui->option()->value("others")->text("Others")->selected($emp_education_details->exam == "others")))
	                                	->show();

										$ui->input()->id('edit_clgname'.$sno)->name('edit_clgname'.$sno)->label('College/University/Institute')->placeholder('Enter College / University / Institute Attended')->width(8)->t_width(8)
											->value($emp_education_details->institute)->show();
                					$row11->close();
                					$row12 = $ui->row()->open();
                    					$ui->input()->id('edit_branch'.$sno)->name('edit_branch'.$sno)->label('Course(Specialization)')->placeholder('Enter Course with Specalization')->width(5)->t_width(5)->value($emp_education_details->branch)->show();
					                    $ui->input()->id("edit_year".$sno)->name("edit_year".$sno)->placeholder("Enter Year")->label('Year')->width(2)->t_width(2)->value($emp_education_details->year)->show();
					                    $ui->input()->id('edit_grade'.$sno)->name('edit_grade'.$sno)->placeholder("Enter Percentage/Grade")->label('Percentage/Grade')->width(3)->t_width(3)->value($emp_education_details->grade)->show();
					                    $ui->input()->id('edit_div'.$sno)->name('edit_div'.$sno)->placeholder("Enter Class/Division")->label('Class/Division')->width(2)->t_width(2)->value($emp_education_details->division)->show();
					                $row12->close();
					                $row13 = $ui->row()->open();
										echo '<center>';
										$ui->button()->uiType('primary')->flat()->submit()
											->name('save')->value('Save')->icon($ui->icon('floppy-o'))->show();
										$ui->button()->uiType('danger')->flat()
											->name('cancel')->value('Cancel')
											->extras('onClick="closeframe();"')->icon($ui->icon('times'))->show();
										echo '</center>';
									$row13->close();
								$box->close();
							$col->close();
						$row->close();
					$form->close();
				}
				break;

		case 5:	if($emp_last5yrstay_details)
				{
					$form = $ui->form()->id('edit_emp_last5yrstay_details')
					->action('employee/edit/update_old_last_5yr_stay_details/'.$sno)
					->extras('onSubmit="return onclick_save('.$sno.');"')->open();
						$row = $ui->row()->open();
							$col = $ui->col()->open();
								$box = $ui->box()->uiType('primary')->style('margin-bottom:0')->open();
									$row11 = $ui->row()->open();
                						$ui->input()->id("edit_addr".$sno)->name("edit_addr".$sno)->value($emp_last5yrstay_details->res_addr)->label('Residential Address')->width(12)->t_width(12)->show();
                					$row11->close();
                					$row12 = $ui->row()->open();
                						$date=date("Y-m-d", time());
	                					$newdate = strtotime ( '-5 year' , strtotime ( $date ) ) ;

                    					$ui->datePicker()->name('edit_from'.$sno)
					                                    ->id('edit_from'.$sno)
					                                    ->dateFormat('dd-mm-yyyy')
					                                    ->addonRight($ui->icon("calendar"))
					                                    ->value(date('d-m-Y',strtotime($emp_last5yrstay_details->from)))
					                                    ->placeholder("dd-mm-yyyy")
					                                    ->label('From')->width(6)->t_width(6)
					                                    ->extras('max="'.date('d-m-Y').'" min="'.date('d-m-Y',$newdate).'"')
					                                    ->show();
					                    $ui->datePicker()->name('edit_to'.$sno)
					                                    ->id('edit_to'.$sno)
					                                    ->dateFormat('dd-mm-yyyy')
					                                    ->addonRight($ui->icon("calendar"))
					                                    ->value(date('d-m-Y',strtotime($emp_last5yrstay_details->to)))
					                                    ->placeholder("dd-mm-yyyy")
					                                    ->label('To')->width(6)->t_width(6)
					                                    ->extras('max="'.date('d-m-Y').'" min="'.date('d-m-Y',$newdate).'"')
					                                    ->show();
									$row12->close();
					            	$row13 = $ui->row()->open();
                    					$ui->input()->id("edit_dist".$sno)->name("edit_dist".$sno)->value($emp_last5yrstay_details->dist_hq_name)->label('Name of District Headquarters')->width(12)->t_width(12)->show();
                					$row13->close();
					                $row14 = $ui->row()->open();
										echo '<center>';
										$ui->button()->uiType('primary')->flat()->submit()
											->name('save')->value('Save')->icon($ui->icon('floppy-o'))->show();
										$ui->button()->uiType('danger')->flat()
											->name('cancel')->value('Cancel')
											->extras('onClick="closeframe();"')->icon($ui->icon('times'))->show();
										echo '</center>';
									$row14->close();
								$box->close();
							$col->close();
						$row->close();
					$form->close();
				}
				break;
	}

?>