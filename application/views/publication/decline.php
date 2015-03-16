<?php

	$ui = new UI();
	$col = $ui->col()->width(2)->open();
	$col->close();
	$col1 = $ui->col()->width(8)->open();
	$form = $ui->form()->action('publication/publication/decline_action')->open();
	$ui->input()->type('hidden')->value($rec_id)->name('rec_id')->show();
	$box = $ui->box()->uiType('primary')->solid()->title('Decline Publications')->open();
		$table = $ui->table()->hover()->bordered()->open();
		?><tr><?
			$ui->textarea()->label('Reason for declining')->name("reason")
				   ->placeholder("Any other details")->required()->show();
		?></tr><tr><?
			$ui->button()->name('Submit')->value('Submit')->submit(true)->uiType('primary')->show();
		?></tr><?
		$table->close();
	$box->close();
	$form->close();
	$col1->close();

?>