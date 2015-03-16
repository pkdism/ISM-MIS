<?php
	$ui = new UI();

	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->title('Individual Student View. ')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	$form = $ui->form()->action('student_view_report/view/view_form')->open();
	
	$inputRow1 = $ui->row()->open();
		 $ui->input()
			->placeholder('Enter Admission No')
			->type('text')
			->label('Admission Number')
			->name('admn_no')
			->width(6)
		    ->show();
		 
	$inputRow1->close();
	
	$ui->button()
		->value('Show')
		->submit(true)
		->uiType('primary')
		->show();
	$form->close();
	$box->close();
	$column2->close();
	
	$row->close();