<?php
	$ui = new UI();

	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->title('File Details')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	$form = $ui->form()->action('file_tracking/send_new_file/insert_file_details')->open();

	$inputRow1 = $ui->row()->open();
		 $ui->input()
			->placeholder('Enter file number')
			->type('text')
			->label('File Number')
			->name('file_no')
			->width(6)
		    ->show();
		 $ui->input()
			->placeholder('Enter file subject')
			->type('text')
			->label('File Subject')
			->name('file_sub')
			->required()
	 		->width(6)
		    ->show();
	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		 $ui->select()
			->label('Department Type')
			->name('type')
			->id('type')
			->required()
			->options(array($ui->option()->value('""')->text('Select')->selected(),
							$ui->option()->value('academic')->text('Academic'),
							$ui->option()->value('nonacademic')->text('Non Academic')))
		    ->width(6)
		    ->show();
		 $ui->select()
			->label('Select Department')
			->name('department_name')
			->id('department_name')
			->required()
			->options(array($ui->option()->value('""')->text('Select')))

			->width(6)
		   	->show();
	$inputRow2->close();

	$inputRow3 = $ui->row()->open();
     	 $ui->select()
			->label('Designation')
			->name('designation')
			->id('designation')
			->required()
			->options(array($ui->option()->value('""')->text('Select')))
   			->width(6)
		   	->show();
		 $ui->select()
			->label('Employee Name')
			->name('emp_name')
			->id('emp_name')
			->required()
			->options(array($ui->option()->value('""')->text('Select')->selected()))
		    ->width(6)
		    ->show();
	$inputRow3->close();

	$ui->textarea()
	   ->label('Remarks')
	   ->name('remarks')
	   ->placeholder('Remarks')
	   ->show();
?>
<center>
<?php
	 $ui->button()
		->value('Send File')
		->submit(true)
		->uiType('primary')
		->show();
	
	$form->close();
	$box->close();
	
	$column2->close();
	
	$row->close();
?>
</center>
