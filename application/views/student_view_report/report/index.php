<?php
	$ui = new UI();

	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->title('Select Different Combination to View Report')
			  ->solid()	
			  ->uiType('primary')
			  ->open();
$form = $ui->form()->action('student_view_report/reports/show_report')->open();
	
	$inputRow1 = $ui->row()->open();
		 $ui->select()
			->label('Select Department')
			->name('department_name')
			->id('department_name')
			//->required()
			->options(array($ui->option()->value('""')->text('Select')))
			
			->width(6)
		   	->show();
		 
		 
		 $ui->select()
			->label('Select Course')
			->name('course')
			->id('course')
			//->required()
			->options(array($ui->option()->value('""')->text('Select')))
							
		    ->width(6)
		    ->show();
		 
	$inputRow1->close();
	
	$inputRow2 = $ui->row()->open();
		 $ui->select()
			->label('Select Branch')
			->name('branch')
			->id('branch')
			//->required()
			->options(array($ui->option()->value('""')->text('Select')))

			->width(6)
		   	->show();
		 
		 
		 $ui->input()
			->placeholder('Enter Semester number')
			->type('text')
			->label('Semester')
			->name('semester')
			->id('semester')
			->width(6)
		    ->show();
		 
	$inputRow2->close();
	
	$inputRow3 = $ui->row()->open();
		 $ui->select()
			->label('Select State')
			->name('state')
			->id('state')
			//->required()
			->options(array($ui->option()->value('""')->text('Select')))

			->width(6)
		   	->show();
		 
		 
		 $ui->input()
			->placeholder('Enter Marks')
			->type('text')
			->label('Enter Marks')
			->name('marks')
			->width(3)
		    ->show();
		 
		 
		 $ui->select()
			->label('Select Condition')
			->name('opmarks')
			->id('opmarks')
			//->required()
			->options(array($ui->option()->value('""')->text('Select')->selected(),
							$ui->option()->value('equal')->text('Equal'),
							$ui->option()->value('notequal')->text('Not Equal'),
							$ui->option()->value('lessthan')->text('Less Than'),
							$ui->option()->value('greaterthan')->text('Greater Than'),
							$ui->option()->value('lteqto')->text('Less Than Equal To'),
							$ui->option()->value('gteqto')->text('Greater Than Equal To')
							
							))
													
							
		    ->width(3)
		    ->show();
			
		 
	$inputRow3->close();
	$inputRow4 = $ui->row()->open();
			$ui->select()
			->label('Select Category')
			->name('category')
			->id('category')
			//->required()
			->options(array($ui->option()->value('""')->text('Select')->selected(),
							$ui->option()->value('general')->text('General'),
							$ui->option()->value('sc')->text('SC'),
							$ui->option()->value('st')->text('ST'),
							$ui->option()->value('obc')->text('OBC'),
							$ui->option()->value('others')->text('Others')
													
							))
							
		    ->width(6)
		    ->show();
			
			$ui->select()
			->label('Select Blood Group')
			->name('bgroup')
			->id('bgroup')
			//->required()
			->options(array($ui->option()->value('""')->text('Select')->selected(),
							$ui->option()->value('A+')->text('A+'),
							$ui->option()->value('B+')->text('B+'),
							$ui->option()->value('O+')->text('O+'),
							$ui->option()->value('AB+')->text('AB+'),
							$ui->option()->value('A-')->text('A-'),
							$ui->option()->value('B-')->text('B-'),
							$ui->option()->value('O-')->text('O-'),
							$ui->option()->value('AB-')->text('AB-')
							
													
							))
							
		    ->width(6)
		    ->show();
	
	$inputRow4->close();
	$inputRow5 = $ui->row()->open();
		 
		 $ui->input()
			->placeholder('Enter Year')
			->type('text')
			->label('Enter Year')
			->name('year')
			->id('year')
			->width(6)
		    ->show();
		 
	$inputRow5->close();

	
?>
<center>
<?php
	 $ui->button()
		->value('Show')
		->submit(true)
		->uiType('primary')
		->show();
	
	$form->close();
	$box->close();
	
	$column2->close();
	
	$row->close();
?>
</center>
