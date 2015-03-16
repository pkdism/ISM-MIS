<?php
	$ui = new UI();

	$row = $ui->row()->open();

	$column1 = $ui->col()->width(2)->open();
	$column1->close();

	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
				->title('Forward File')
				->solid()
				->uiType('primary')
				->open();

	$form = $ui->form()->action('file_tracking/send_new_file/insert_move_details_main/'.$file_id)->open();

	$inputRow1 = $ui->row()->open();
		if ($file_no)
		{	
			 $ui->input()
				->placeholder('Enter file number')
				->type('text')
				->label('File Number')
				->name('file_no')
				->value($file_no)
				->disabled()
				->width(6)
				->show();
		}
		else
		{
			 $ui->input()
				->placeholder('File No. not yet generated')
				->type('text')
				->label('File Number')
				->name('file_no')
				->width(6)
				->show();			
		}

		$ui->input()
			->placeholder('Enter file subject')
			->type('text')
			->label('File Subject')
			->name('file_sub')
			->value($file_sub)
//			->extras('readonly')
			->disabled()
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
			->options(array($ui->option()->value('""')->text('Select')->selected()))

			->width(6)
				->show();
	$inputRow2->close();

	$inputRow3 = $ui->row()->open();
				$ui->select()
			->label('Designation')
			->name('designation')
			->id('designation')
			->required()
			->options(array($ui->option()->value('""')->text('Select')->selected()))
				->width(6)
				->show();
		$ui->select()
			->label('Employee Name')
			->name('emp_name')
			->id('emp_name')
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
		->uiType('primary')
		->submit(true)
		->show();

	$form->close();
?>
</center>
<h2 align="center">OR</h2>
<?php
	$form2 = $ui->form()->action('file_tracking/send_new_file/insert_move_details/'.$file_id.'/'.$sent_by_emp_id)->open();

	 $ui->input()
		->type('hidden')
		->name('file_no')
		->value($file_no)
		->show();

	$ui->textarea()
		->label('Enter Remarks and Send Back')
		->name('remarks')
		->placeholder('Remarks')
		->show();
?>
<center>
<?php
	$ui->button()
		->value('Send File Back')
		->uiType('primary')
		->submit()
		->show();

	$form2->close();

	$box->close();

	$column2->close();

	$row->close();
?>
</center>
