<?php
	$ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
			$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			
				$formbox =  $ui->box()->id('box_form')->title("Select Company to view JNF")->open();
                    $form=$ui->form()->id("add_course_form")->action("tnpcell/view_jnf/ViewJNF")->multipart()->open();
						
						$array_options = array();
						foreach($company_basic_info as $row)
							array_push($array_options,$ui->option()->value($row->company_id)->text($row->company_name." (".$row->session.")"));
							
						$ui->select()
						   ->id("ddl_company")
						   ->name("ddl_company")
						   ->options($array_options)
						   ->show();
						
						$ui->button()
							->value('View JNF')
							->uiType('primary')
							->submit()
							->name('submit')
							->show();
					$form->close();
				$formbox->close();
			$column1->close();
		$outer_row->close();
?>