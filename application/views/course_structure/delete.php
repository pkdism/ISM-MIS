<?php
 $ui = new UI();
    $outer_row = $ui->row()->id('or')->open();
		$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			$box_outter = $ui->box()->id("box_outter")->open();
				$table = $ui->table()->id('table')->open();
					echo "<tr><th width='50%'>Delete Course</th><th width='50%'>Delete Branch</th></tr>";
					echo "<tr><td id = 'td_course'>";
					$array_options = array();
						$array_options[0] = $ui->option()->value("0")->text("Select Course")->disabled()->selected();
						foreach ($result_course as $row) 
							array_push($array_options,$ui->option()->value($row->id)->text($row->name));
										
							$ui->select()
								->label('Select Course')
								->name('course')
								->id("course_selection")
								->containerId("cont_course_selection")
								->options($array_options)
								->show();
							
							$ui->button()
								->value('Delete Course')
								->uiType('primary')
								->submit()
								->id("btn_course")
								->name('btn_course')
								->show();
					echo "</td>";
					
					echo "<td id = 'td_branch'>";
					$array_options = array();
					$array_options[0] = $ui->option()->value("0")->text("Select Branch")->disabled()->selected();
						foreach ($result_branch as $row) 
							array_push($array_options,$ui->option()->value($row->id)->text($row->name));
										
							$ui->select()
								->label('Select Branch')
								->name('branch')
								->id("branch_selection")
								->containerId("cont_branch_selection")
								->options($array_options)
								->show();
							
							$ui->button()
								->value('Delete Branch')
								->uiType('primary')
								->submit()
								->id("btn_branch")
								->name('btn_branch')
								->show();	
					echo "</td></tr>";	
				$table->close();
			$box_outter->close();
		$column1->close();
	$outer_row->close();
?>