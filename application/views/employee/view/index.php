<?php $ui = new UI();

	$view_row = $ui->row()->open();
		$col = $ui->col()->width(6)->t_width(6)->open();
			$view_box = $ui->box()->uiType('primary')->title('Choose Employee to View')->open();
				$form = $ui->form()->action('employee/view/view_form')->open();

					$options = array();
					if($employees)
						foreach($employees as $row)
							array_push($options,$ui->option()->value($row->id)->text($row->id));
					else
						array_push($options,$ui->option()->value("")->text("No Employees")->disabled());
					$ui->select()->label('Employee Id')
                                ->name('emp_id')
                                ->id('emp_id')
                                ->options($options)
                                ->addonRight($ui->button()->id('search_btn')->value('Search')->uiType('primary')->icon($ui->icon('search')))
                                ->show();

					$ui->button()->value('Submit')
	                            ->uiType('primary')
	                            ->submit()
	                            ->name('submit')
	                            ->show();

				$form->close();
			$view_box->close();
		$col->close();


        $col = $ui->col()->width(6)->t_width(6)->open();
        echo '<div id="search_eid" style="display:none">';
            $sel_box = $ui->box()->title('Search by Department')->open();
                    $options = array($ui->option()->text('Select Employee Department')->disabled()->selected());
                    if($departments)
                        foreach($departments as $row)
                            array_push($options,$ui->option()->value($row->id)->text($row->name));
                    else
                        array_push($options,$ui->option()->value("")->text("No Departments")->disabled());
                    $ui->select()->label('Department')->id('emp_dept')->options($options)->show();

                    echo '<div id="employee" style="display:none">';
                    $options = array($ui->option()->value("")->text('No Employee found')->disabled());
                    $ui->select()->label('Employee Name')->id('employee_select')->options($options)->show();
                    echo '</div>';
            $sel_box->close();
        echo '</div>';
        $col->close();
	$view_row->close();
?>