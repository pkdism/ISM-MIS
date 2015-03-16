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
			  ->title('Edit Minutes Details')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	$form = $ui->form()->extras('enctype="multipart/form-data"')->action('information/edit_minute/edit/'.$minute_row->minutes_id)->open();
	$inputRow1 = $ui->row()->open();
		
			
			$ui->input()
			   ->type('text')
			   ->label('Minutes ID<span style= "color:red;"> *</span>')
			   ->name('minutes_ids')
			   ->required()
			   ->width(6)
			   ->value($minute_row->minutes_id)
			   ->disabled()
			   ->show();			

		 $ui->input()
		    ->type('text')
		    ->label('Minutes Number<span style= "color:red;"> *</span>')
		    ->name('minutes_no')
		    ->value($minute_row->minutes_no)
		    ->required()
		    ->width(6)
		    ->placeholder('Enter Minutes Number  (Ex: CSE_10185)')
		    ->show();

	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		if($minute_row->meeting_cat=='emp')
			$ui->select()
			->label('Viewed By<span style= "color:red;"> *</span>')
			->name('meeting_cat')
			->options(array($ui->option()->value('emp')->text('Employee')->selected(),
							$ui->option()->value('stu')->text('Student'),
							$ui->option()->value('all')->text('All')))
			->width(6)
			->show();
		if($minute_row->meeting_cat=='stu')
			$ui->select()
			->label('Viewed By<span style= "color:red;"> *</span>')
			->name('meeting_cat')
			->options(array($ui->option()->value('emp')->text('Employee'),
							$ui->option()->value('stu')->text('Student')->selected(),
							$ui->option()->value('all')->text('All')))
			->width(6)
			->show();
		if($minute_row->meeting_cat=='all')
			$ui->select()
			->label('Viewed By<span style= "color:red;"> *</span>')
			->name('meeting_cat')
			->options(array($ui->option()->value('emp')->text('Employee'),
							$ui->option()->value('stu')->text('Student'),
							$ui->option()->value('all')->text('All')->selected()))
			->width(6)
			->show();

		$ui->input()
		   ->type('text')
		   ->name('place_of_meeting')
		   ->value($minute_row->place_of_meeting)
		   ->width(6)
		   ->required()
		   ->placeholder('CSE Department')
		   ->label('Place of Meeting<span style= "color:red;"> *</span>')
		   ->show();


	$inputRow2->close();
	$inputRow3=$ui->row()->open();

		if($minute_row->meeting_type=='Dean\'s Meeting')
		{
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
				$ui->input()->type('text')->name('meeting_others')->disabled()->id('others')->label('Other Type')->width(6)->placeholder('Only if Meeting Type other is selected')->show();

		}
		else if($minute_row->meeting_type=='HOD\'s Meeting')
		{
			$ui->select()
			    ->label('Meeting Type<span style= "color:red;"> *</span>')
				->name('meeting_type')
				->options(array($ui->option()->value('Dean\'s Meeting')->text('Dean\'s Meeting'),
								$ui->option()->value('HOD\'s Meeting')->text('HOD\'s Meeting')->selected(),
								$ui->option()->value('GC Meeting')->text('GC Meeting'),
								$ui->option()->value('DAC Meeting')->text('DAC Meeting'),
								$ui->option()->value('others')->text('others'),
								))
				->extras('onchange="javascript: if(this.value '."== 'others') document.getElementById('others').removeAttribute('disabled'); else document.getElementById('others').setAttribute('disabled','disabled');".'" "')
				->width(6)
				->show();
				$ui->input()->type('text')->name('meeting_others')->disabled()->id('others')->label('Other Type')->width(6)->placeholder('Only if Meeting Type other is selected')->show();

		}
		else if($minute_row->meeting_type=='GC Meeting')
		{
			$ui->select()
			    ->label('Meeting Type<span style= "color:red;"> *</span>')
				->name('meeting_type')
				->options(array($ui->option()->value('Dean\'s Meeting')->text('Dean\'s Meeting'),
								$ui->option()->value('HOD\'s Meeting')->text('HOD\'s Meeting'),
								$ui->option()->value('GC Meeting')->text('GC Meeting')->selected(),
								$ui->option()->value('DAC Meeting')->text('DAC Meeting'),
								$ui->option()->value('others')->text('others'),
								))
				->extras('onchange="javascript: if(this.value '."== 'others') document.getElementById('others').removeAttribute('disabled'); else document.getElementById('others').setAttribute('disabled','disabled');".'" "')
				->width(6)
				->show();
				$ui->input()->type('text')->name('meeting_others')->disabled()->id('others')->label('Other Type')->width(6)->placeholder('Only if Meeting Type other is selected')->show();

		}
		else if($minute_row->meeting_type=='DAC Meeting')
		{
			$ui->select()
			    ->label('Meeting Type<span style= "color:red;"> *</span>')
				->name('meeting_type')
				->options(array($ui->option()->value('Dean\'s Meeting')->text('Dean\'s Meeting'),
								$ui->option()->value('HOD\'s Meeting')->text('HOD\'s Meeting'),
								$ui->option()->value('GC Meeting')->text('GC Meeting'),
								$ui->option()->value('DAC Meeting')->text('DAC Meeting')->selected(),
								$ui->option()->value('others')->text('others'),
								))
				->extras('onchange="javascript: if(this.value '."== 'others') document.getElementById('others').removeAttribute('disabled'); else document.getElementById('others').setAttribute('disabled','disabled');".'" "')
				->width(6)
				->show();
				$ui->input()->type('text')->name('meeting_others')->disabled()->id('others')->label('Other Type')->width(6)->placeholder('Only if Meeting Type other is selected')->show();

		}
		else
		{	

			$ui->select()
			    ->label('Meeting Type<span style= "color:red;"> *</span>')
				->name('meeting_type')
				->options(array($ui->option()->value('Dean\'s Meeting')->text('Dean\'s Meeting'),
								$ui->option()->value('HOD\'s Meeting')->text('HOD\'s Meeting'),
								$ui->option()->value('GC Meeting')->text('GC Meeting'),
								$ui->option()->value('DAC Meeting')->text('DAC Meeting'),
								$ui->option()->value('others')->text('others')->selected(),
								))
				->extras('onchange="javascript: if(this.value '."== 'others') document.getElementById('others').removeAttribute('disabled'); else document.getElementById('others').setAttribute('disabled','disabled');".'" "')
				->width(6)
				->show();

				$ui->input()->type('text')->name('meeting_others')->id('others')->label('Other Type')->value($minute_row->meeting_type)->width(6)->placeholder('Only if Meeting Type other is selected')->show();
		}




	$inputRow3->close();
	$inputRow4=$ui->row()->open();

		$ui->datePicker()
						->name('date_of_meeting')
						->label('Date of Meeting<span style= "color:red;"> *</span>')
						->value($minute_row->date_of_meeting)
						->width(6)
						->dateFormat('yyyy-mm-dd')
						->show();
		$ui->datePicker()
					->name('valid_upto')
				    ->label('Last Date<span style= "color:red;"> *</span> (Atleast today)')			
					//->extras("min='".date("Y-m-d")."'")
					->value($minute_row->valid_upto)
					->dateFormat('yyyy-mm-dd')->width(6)
					->show();
	$inputRow4->close();
	
	$inputRow5 = $ui->row()->open(); 	 
		$coll=$ui->col()->width(3)->open();
			echo '<a href="'.base_url().'assets/files/information/minute/'.$minute_row->minutes_path.'" title="download file" download="'.$minute_row->minutes_path.'">'.$minute_row->minutes_path.'</a>';
		    $js = 'onclick="javascript:document.getElementById(\'filebox\').style.display=\'block\';"';
		$coll->close();
		$co=$ui->col()->width(1)->open();
		$co->close();
		$colll=$ui->col()->width(4)->open();
			$ui->button()
				->value('Change File')
			    ->uiType('primary')
			    ->extras($js)
			    //->submit()
			    ->show();
		$colll->close();
	$inputRow5->close();
	$inputRow6=$ui->row()->id('filebox')->extras('style="display:none"')->open();
		   
		     	 $ui->input()
				    ->label('Minutes File<span style= "color:red;"> *</span>')
		     	    ->type('file')
		     	    ->id('minutes_path')
		     	    ->name('minutes_path')
		     	    //->required()
		     	    ->width(6)
		     	    ->show();  
		     	    echo"<br/>(Allowed Types: pdf, doc, docx, jpg, jpeg, png and Max Size: 1.0 MB)";  

	$inputRow6->close();
	
				
				
		$ui->input()
		   ->type('hidden')
		   ->name('minutes_id')
		   ->required()
		   ->value($minute_row->minutes_id)
		   ->show();
		$ui->input()
		   ->type('hidden')
		   ->name('modification_value')
		   ->required()
		   ->value($minute_row->modification_value)
		   ->show();
?>
<center>
<?php
	 $ui->button()
		->value('Edit minutes')
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
