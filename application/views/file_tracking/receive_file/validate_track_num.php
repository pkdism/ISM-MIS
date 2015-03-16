<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(2)->open();
	$column1->close();

	$column2 = $ui->col()->width(8)->open();

	$box = $ui->box()
			  ->title('Track Number')	
			  ->solid()
			  ->uiType('primary')
			  ->open();

		 $ui->input()
			->placeholder('Enter Track number')
			->type('text')
			->label('Enter Track Number :')
			->name('track_num')
			->id('track_num')
		    ->show();
?>
<center>
<?php		
		 $ui->button()
			->value('Validate')
			->id('Validate')
			->uiType('primary')
			->show();

		 $ui->input()
			->type('hidden')
			->id('file_id')
			->value ($file_id)
		    ->show();
?>
</center>
<div id="send">
</div>
<?php	  
	$box->close();
	
	$column2->close();
	
	$outer_row->close();
?>
