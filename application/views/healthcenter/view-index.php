<?php
	$ui = new UI();

	$row = $ui->row()->open();
	
	
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->title('Enter Health Center Approximate Financial Budget ')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	$form = $ui->form()->action('healthcenter/add_finyear/insert')->open();
	
	$inputfy = $ui->row()->open();
		 $ui->input()
			->placeholder('like 2015-2016')
			->type('text')
			->label('Enter Financial Year')
			->name('fin_year')
			->id('fin_year')
			->width(6)
		    ->show();
		 
	$inputfy->close();
	
	$inputbudget = $ui->row()->open();
		 $ui->input()
			->placeholder('Enter Budget')
			->type('text')
			->label('Enter Budget')
			->name('budget_amt')
			->id('budget_amt')
			->width(6)
		    ->show();
		 
	$inputbudget->close();
	
	$ui->button()
		->value('Submit')
		->submit(true)
		->uiType('primary')
		->show();
	$form->close();
	$box->close();
	$column2->close();
	
	$row->close();
	?>
	