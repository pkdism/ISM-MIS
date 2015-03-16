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
			  ->title('Notice Details')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	$form = $ui->form()->extras('enctype="multipart/form-data"')->action('information/edit_notice/edit/'.$notice_row->notice_id)->open();
	$star_notice=$ui->row()->open();
	//echo" Fields marked with <span style= 'color:red;'>*</span> are mandatory.";
	$star_notice->close();
	$inputRow1 = $ui->row()->open();

		$ui->input()
		   ->type('text')
		   ->label('Notice ID<span style= "color:red;"> *</span>')
		   ->name('notice_ids')
		   ->required()
		   ->width(6)
		   ->value($notice_row->notice_id)
		   ->disabled()
		   ->show();			
		

		 $ui->input()
		    ->type('text')
		    ->label('Notice Number<span style= "color:red;"> *</span>')
		    ->name('notice_no')
		    ->value($notice_row->notice_no)
		    ->required()
		    ->width(6)
		    ->show();

	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
	if($notice_row->notice_cat=='emp')
			 $ui->select()
			    ->label('Viewed By<span style= "color:red;"> *</span>')
				->name('notice_cat')
				->options(array($ui->option()->value('emp')->text('Employee')->selected(),
								$ui->option()->value('stu')->text('Student'),
								$ui->option()->value('all')->text('All')))
				->width(6)
				->show();
	else if($notice_row->notice_cat=='stu')
		$ui->select()
			    ->label('Viewed By<span style= "color:red;"> *</span>')
				->name('notice_cat')
				->options(array($ui->option()->value('emp')->text('Employee'),
								$ui->option()->value('stu')->text('Student')->selected(),
								$ui->option()->value('all')->text('All')))
				->width(6)
				->show();
	else
		$ui->select()
			    ->label('Viewed By<span style= "color:red;"> *</span>')
				->name('notice_cat')
				->options(array($ui->option()->value('emp')->text('Employee'),
								$ui->option()->value('stu')->text('Student'),
								$ui->option()->value('all')->text('All')->selected()))
				->width(6)
				->show();

		$ui->datePicker()
			->name('last_date')
		    ->label('Last Date<span style= "color:red;"> *</span> (Atleast today)')			
			//->extras(min='date("Y-m-d")')
			->dateFormat('yyyy-mm-dd')
			->value($notice_row->last_date)			
			->width(6)
			->show();
	$inputRow2->close();

	$inputRow3=$ui->row()->open();
		$ui->textarea()
		    ->label('Notice Subject<span style= "color:red;"> *</span>')
            ->placeholder('Enter the notice Subject in not more than 200 characters')
            ->name('notice_sub')
            ->value($notice_row->notice_sub)
            ->required()->width(8)
            ->show();
	$inputRow3->close();

	$inputRow4 = $ui->row()->open();
	$coll=$ui->col()->width(3)->open();
		echo '<a href="'.base_url().'assets/files/information/notice/'.$notice_row->notice_path.'" title="download file" download="'.$notice_row->notice_path.'">'.$notice_row->notice_path.'</a>';
	    $js = 'onclick="javascript:document.getElementById(\'filebox\').style.display=\'block\';"';
	$coll->close();
	$colll=$ui->col()->width(4)->open();
		$ui->button()
			->value('Change File')
		    ->uiType('primary')
		    ->extras($js)
		    //->submit()
		    ->show();
	$colll->close();
	$inputRow4->close();
	$inputRow5=$ui->row()->id('filebox')->extras('style="display:none"')->open();
		   
		     	 $ui->input()
				    ->label('Notice File<span style= "color:red;"> *</span>')
		     	    ->type('file')
		     	    ->id('notice_path')
		     	    ->name('notice_path')
		     	    //->required()
		     	    ->width(6)
		     	    ->show();  
		     	    echo"<br/>(Allowed Types: pdf, doc, docx, jpg, jpeg, png and Max Size: 1.0 MB)";  

	$inputRow5->close();
	
				
		$ui->input()
		   ->type('hidden')
		   ->name('notice_id')
		   //->required()
		   ->value($notice_row->notice_id)
		   ->show();
		$ui->input()
		   ->type('hidden')
		   ->name('modification_value')
		   //->required()
		   ->value($notice_row->modification_value)
		   ->show();
		
?>
<center>
<?php
	 $ui->button()
		->value('Update Notice')
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
