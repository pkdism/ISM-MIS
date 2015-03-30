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
			  ->title('Minute Details')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	$form = $ui->form()->extras('enctype="multipart/form-data"')->action('information/post_minute/index/'.$auth_id)->open();
	$inputRow1 = $ui->row()->open();
		if($id->minutes_id == NULL)
		{
			
			$ui->input()
			   ->label('Minutes ID<span style= "color:red;"> *</span>')
			   ->type('text')
			   ->name('minutes_ids')
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
			   ->label('Minutes ID<span style= "color:red;"> *</span>')
			   ->name('minutes_ids')
			   ->required()
			   ->width(6)
			   ->value($id->minutes_id + 1)
			   ->disabled()
			   ->show();			
		}

		 $ui->input()
		    ->type('text')
		    ->label('Minutes Number<span style= "color:red;"> *</span>')
		    ->name('minutes_no')
		    ->required()
		    ->width(6)
		    ->placeholder('Enter Minutes Number  (Ex: CSE_MINUTE_10185)')
		    ->show();

	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		 $ui->select()
		    ->label('Viewed By<span style= "color:red;"> *</span>')
			->name('meeting_cat')
			->options(array($ui->option()->value('emp')->text('Employee')->selected(),
							$ui->option()->value('stu')->text('Student'),
							$ui->option()->value('all')->text('All')))
			->width(6)
			->show();


		$ui->input()
		    ->label('Minutes File<span style= "color:red;"> *</span>')
     	    ->type('file')
     	    ->name('minutes_path')
     	    ->required()
     	    ->width(6)
     	    ->show();


	$inputRow2->close();
	$inputRow3=$ui->row()->open();
		$ui->select()
		    ->label('Meeting Type<span style= "color:red;"> *</span>')
			->name('meeting_type')
			->options(array($ui->option()->value('Dean\'s Meeting')->text('Dean\'s Meeting')->selected(),
							$ui->option()->value('HOD\'s Meeting')->text('HOD\'s Meeting'),
							$ui->option()->value('GC Meeting')->text('GC Meeting'),
							$ui->option()->value('DAC Meeting')->text('DAC Meeting'),
							$ui->option()->value('others')->text('others'),
							))
			->extras('onchange="javascript: if(this.value '."== 'others') document.getElementById('others').removeAttribute('disabled'); else document.getElementById('others').setAttribute('disabled','disabled');".'" "')
			->width(6)
			->show();
			$ui->input()->type('text')->name('meeting_others')->id('others')->label('Other Type')->width(6)->placeholder('Only if Meeting Type other is selected')->disabled()->show();
	$inputRow3->close();
	$inputRow4=$ui->row()->open();

		$ui->datePicker()
						->name('date_of_meeting')
						->label('Date of Meeting<span style= "color:red;"> *</span>')
						->value(date("yy-mm-dd"))
						->width(6)
						->dateFormat('yy-mm-dd')
						->show();
		$ui->input()->type('text')->name('place_of_meeting')->width(6)->required()->placeholder('CSE Department')->label('Place of Meeting<span style= "color:red;"> *</span>')->show();

	$inputRow4->close();
	
	$inputRow5 = $ui->row()->open(); 	 
		 $ui->datePicker()
			->name('valid_upto')
		    ->label('Last Date<span style= "color:red;"> *</span> (Atleast today)')			
			//->extras("min='".date("Y-m-d")."'")
			->value(date("yy-mm-dd"))
			->dateFormat('yy-mm-dd')->width(6)
			->show();
	$inputRow5->close();
	echo"(Allowed File Types: pdf, doc, docx, jpg, jpeg, png and Max Size: 1.0 MB)";
	$value=1;
		if($id->minutes_id != NULL)
		   $value = $id->minutes_id +1;
				
				
		$ui->input()
		   ->type('hidden')
		   ->name('minutes_id')
		   ->required()
		   ->value($value)
		   ->show();
?>
<center>
<?php
	 $ui->button()
		->value('Post minutes')
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
