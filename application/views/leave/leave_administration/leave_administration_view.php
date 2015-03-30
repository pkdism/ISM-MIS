<?php
/*
 * Author :- Nishant Raj
 */
	$ui = new UI();

	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->title('Leave Details')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	//$form = $ui->form()->action('file_tracking/send_new_file/insert_file_details')->open();

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
        
        $inputRow3 = $ui->row()->id('leave_date_picker')->open();
        
        $ui->datePicker()
                ->label('Starting Date')
                ->name('leave_start_date')
                ->id('leave_start_date')
                ->dateFormat('dd-mm-yyyy')
                ->width(6)
                ->value("")
                ->show();
        $ui->datePicker()
                ->label('Ending Date')
                ->name('leave_end_date')
                ->id('leave_end_date')
                ->value("")
                ->width(6)
                ->show();
        $inputRow3->close();
?>
<center>
<?php

	$box->close();
	
	$column2->close();
	
	$row->close();
        $column5 = $ui->col()->id('leave_details')->width(12)->open();
        $column5->close();
?>
</center>
<script charset="utf-8">
	$("#emp_name").on('change', function() {
		if (this.value != "")
		{
			$('#leave_date_picker').show();
		}
	});
	$(window).load(function(){
		$('#leave_date_picker').hide();
                
                $.ajax({url : site_url("leave/leave_ajax/get_emp_name/"+$(this).val()+"/"+$('#department_name').val()),
				success : function (result) {
					$('#leave_details').html(result);
				}});
	});
	//$("#date")
</script>