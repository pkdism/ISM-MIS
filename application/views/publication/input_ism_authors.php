<?php
	$ui= new UI();
	$row = $ui->row()->open();
	
		$row1 = $ui->row()->open();
		$col_left=$ui->col()->width(6)->id('depart')->open();
			$ui->select()
				->label('Select Department')
				->name('department_name'.$author_no)
				->id('department_name'.$author_no)
				->required()
				->extras(' onchange="find_faculty(this.value,'.$author_no.')" ')
				->options(array($ui->option()->value('""')->text('Select')))
				->show();
		$col_left->close();
		$col_right=$ui->col()->width(6)->open();
			$ui->select()
				->label('Faculty Name')
				->name('author_'.$author_no.'_emp_id')
				->id('author_'.$author_no.'_emp_id')
				->required()
				->options(array($ui->option()->value('""')->text('Select')))
				->show();

		$col_right->close();
	$row->close();
?>