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

	$form = $ui->form()->extras('enctype="multipart/form-data"')->action('information/edit_circular/edit/'.$circular_row->circular_id)->open();
	$star_circular=$ui->row()->open();
	//echo" Fields marked with <span style= 'color:red;'>*</span> are mandatory.";
	$star_circular->close();
	$inputRow1 = $ui->row()->open();

		$ui->input()
		   ->type('text')
		   ->label('Circular ID<span style= "color:red;"> *</span>')
		   ->name('circular_ids')
		   ->required()
		   ->width(6)
		   ->value($circular_row->circular_id)
		   ->disabled()
		   ->show();			
		

		 $ui->input()
		    ->type('text')
		    ->label('Circular Number<span style= "color:red;"> *</span>')
		    ->name('circular_no')
		    ->value($circular_row->circular_no)
		    ->required()
		    ->width(6)
		    ->show();

	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
	if($circular_row->circular_cat=='emp')
			 $ui->select()
			    ->label('Viewed By<span style= "color:red;"> *</span>')
				->name('circular_cat')
				->options(array($ui->option()->value('emp')->text('Employee')->selected(),
								$ui->option()->value('stu')->text('Student'),
								$ui->option()->value('all')->text('All')))
				->width(6)
				->show();
	else if($circular_row->circular_cat=='stu')
		$ui->select()
			    ->label('Viewed By<span style= "color:red;"> *</span>')
				->name('circular_cat')
				->options(array($ui->option()->value('emp')->text('Employee'),
								$ui->option()->value('stu')->text('Student')->selected(),
								$ui->option()->value('all')->text('All')))
				->width(6)
				->show();
	else
		$ui->select()
			    ->label('Viewed By<span style= "color:red;"> *</span>')
				->name('circular_cat')
				->options(array($ui->option()->value('emp')->text('Employee'),
								$ui->option()->value('stu')->text('Student'),
								$ui->option()->value('all')->text('All')->selected()))
				->width(6)
				->show();

		$ui->datePicker()
			->name('valid_upto')
		    ->label('Last Date<span style= "color:red;"> *</span> (Atleast today)')			
			//->extras(min='date("Y-m-d")')
			->value($circular_row->valid_upto)
			->dateFormat('yyyy-mm-dd')
			->width(6)
			->show();
	$inputRow2->close();

	$inputRow3=$ui->row()->open();
		$ui->textarea()
		    ->label('Circular Subject<span style= "color:red;"> *</span>')
            ->placeholder('Enter the circular Subject in not more than 200 characters')
            ->name('circular_sub')
            ->value($circular_row->circular_sub)
            ->required()->width(8)
            ->show();
	$inputRow3->close();

	$inputRow4 = $ui->row()->open();
	$coll=$ui->col()->width(3)->open();
		echo '<a href="'.base_url().'assets/files/information/circular/'.$circular_row->circular_path.'" title="download file" download="'.$circular_row->circular_path.'">'.$circular_row->circular_path.'</a>';
	    $js = 'onclick="javascript:document.getElementById(\'filebox\').style.display=\'block\';"';
	$coll->close();
	$colll=$ui->col()->width(4)->open();
		$ui->button()
			->value('Change File')
		    ->uiType('primary')
		    ->extras($js)
		    ->show();
	$colll->close();
	$inputRow4->close();
	$inputRow5=$ui->row()->id('filebox')->extras('style="display:none"')->open();
		   
		     	 $ui->input()
				    ->label('Circular File<span style= "color:red;"> *</span>')
		     	    ->type('file')
		     	    ->id('circular_path')
		     	    ->name('circular_path')
		     	    //->required()
		     	    ->width(6)
		     	    ->show();   

	$inputRow5->close();
	
				
		$ui->input()
		   ->type('hidden')
		   ->name('circular_id')
		   ->required()
		   ->value($circular_row->circular_id)
		   ->show();
		$ui->input()
		   ->type('hidden')
		   ->name('modification_value')
		   ->required()
		   ->value($circular_row->modification_value)
		   ->show();
		echo"(Allowed Types: pdf, doc, docx, jpg, jpeg, png and Max Size: 1.0 MB)"; 
?>
<center>
<?php
	 $ui->button()
		->value('Update Circular')
	    ->uiType('primary')
	    ->submit(true)
	    ->name('mysubmit')
	    ->show();
	
	$form->close();
	$box->close();
	
	$column2->close();
	
	$row->close();
?>
</center>
