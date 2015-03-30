<?php
	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	$column2 = $ui->col()->width(9)->open();
	$box = $ui->box()
			  ->title('Circular Details')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	$form = $ui->form()->action('information/post_circular/index/'.$auth_id)->extras('enctype="multipart/form-data"')->open();
	$star_circular=$ui->row()->open();
	//echo" Fields marked with <span style= 'color:red;'>*</span> are mandatory.";
	$star_circular->close();
	$inputRow1 = $ui->row()->open();
		if($id->circular_id == NULL)
		{
			
			$ui->input()
			   ->label('Circular ID<span style= "color:red;"> *</span>')
			   ->type('text')
			   ->name('circular_ids')
			   ->required()
			   ->value('1')
			   ->disabled()
			   ->width(6)
			   ->show();

		}
		else
		{
			$ui->input()
			   ->type('text')
			   ->label('Circular ID<span style= "color:red;"> *</span>')
			   ->name('circular_ids')
			   ->required()
			   ->width(6)
			   ->value($id->circular_id + 1)
			   ->disabled()
			   ->show();			
		}

		 $ui->input()
		    ->type('text')
		    ->label('Circular Number<span style= "color:red;"> *</span>')
		    ->name('circular_no')
		    ->required()
		    ->width(6)
		    ->placeholder('Enter Circular Number  (Ex: CSE_CIRC_10185)')
		    ->show();

	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		 $ui->select()
		    ->label('Viewed By<span style= "color:red;"> *</span>')
			->name('circular_cat')
			->options(array($ui->option()->value('emp')->text('Employee')->selected(),
							$ui->option()->value('stu')->text('Student'),
							$ui->option()->value('all')->text('All')))
			->width(6)
			->show();

		 $ui->textarea()
		    ->label('Circular Subject<span style= "color:red;"> *</span>')
            ->placeholder('Enter the circular Subject in not more than 200 characters')
            ->name('circular_sub')
            ->required()->width(8)
            ->show();
	$inputRow2->close();

	$inputRow3 = $ui->row()->open();
     	 $ui->input()
		    ->label('Circular File<span style= "color:red;"> *</span>')
     	    ->type('file')
     	    ->name('circular_path')
     	    ->required()
     	    ->width(6)
     	    ->show();

		 $ui->datePicker()
			->name('valid_upto')
		    ->label('Last Date<span style= "color:red;"> *</span> (Atleast today)')			
			//->extras(min='date("Y-m-d")')
			->value(date("yy-mm-dd"))
			->dateFormat('yy-mm-dd')->width(6)
			->show();


	$inputRow3->close();
	echo"(Allowed Types: pdf, doc, docx, jpg, jpeg, png and Max Size: 1.0 MB)";
	$value=1;
		if($id->circular_id != NULL)
		   $value = $id->circular_id +1;
				
				
		$ui->input()
		   ->type('hidden')
		   ->name('circular_id')
		   ->required()
		   ->value($value)
		   ->show();
?>
<center>
<?php
	 $ui->button()
		->value('Post Circular')
	    ->uiType('primary')
	    ->submit()
	    ->name('mysubmit')
	    ->show();
	
	$form->close();
	$box->close();
	
	$column2->close();
	
	$row->close();
?>
</center>
