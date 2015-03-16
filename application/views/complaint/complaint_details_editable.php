<?php
	$ui = new UI();
//echo form_open('complaint/register_complaint/insert');   	
	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->solid()
			  ->title("Complaint ID: ".$complaint_id)
			  ->uiType('primary')
			  ->open();

	$form = $ui->form()->action('complaint/supervisor/update_complaint_details/'.$complaint_id.'/'.$type)->open();

	$inputRow1 = $ui->row()->open();
		$c1 = $ui->col()->width(4)->open();
			?><p><strong><? $ui->icon("user")->show() ?> Complaint By</strong><br/>
			  <sapn><?= $complaint_by ?></span></p><?
		$c1->close();
		$c2 = $ui->col()->width(4)->open();
			?><p><strong><? $ui->icon("mobile")->show() ?> Mobile No</strong><br/>
			  <span><?= $mobile ?></span></p><?
		$c2->close();
		$c3 = $ui->col()->width(4)->open();
			?><p><strong><? $ui->icon("mail-forward")->show() ?> Email ID</strong><br/>
			  <span><?= $email ?></span></p><?
		$c3->close();
	$inputRow1->close();
	

	$inputRow2 = $ui->row()->open();
		$c1 = $ui->col()->width(4)->open();
			?><p><strong><? $ui->icon("clock-o")->show() ?> Registered On</strong><br/>
			  <sapn><?= $date_n_time ?></span></p><?
		$c1->close();
		$c2 = $ui->col()->width(4)->open();
			?><p><strong> <? $ui->icon("location-arrow")->show() ?>Location </strong><br/>
			  <span><?= $location ?></span></p><?
		$c2->close();
		$c3 = $ui->col()->width(4)->open();
			?><h5><strong> Location Details </strong></h5><?
			?><h5><?= $location_details ?></h5><?
		$c3->close();
	$inputRow2->close();


	$inputRow3 = $ui->row()->open();
		$c1 = $ui->col()->width(4)->open();
			?><p><strong><? $ui->icon("clock-o")->show() ?> Prefered Time</strong><br/>
			  <sapn><?= $pref_time ?></span></p><?
		$c1->close();
		$c2 = $ui->col()->width(4)->open();
			?><p><strong> Problem Details </strong><br/>
			  <span><?= $problem_details ?></span></p><?
		$c2->close();
		$c3 = $ui->col()->width(4)->open();
//				$ui->textarea()->label('Action Taken')->name("action_taken")->value($remarks)->disabled()->show();
			?><p><strong> Action Taken </strong><br/>
			  <sapn><?= $remarks ?></span></p><?
		$c3->close();
	$inputRow3->close();

	$inputRow4 = $ui->row()->open();
		$c1 = $ui->col()->width(6)->open();
				$ui->textarea()->label('Fresh Action')->name("fresh_action")->placeholder('Fresh Action')->required()->show();
		$c1->close();
		$c2 = $ui->col()->width(4)->open();
				$ui->select()
				   ->label('Status')
				   ->name('status')
				   ->required()
				   ->options(array( $ui->option()->value("Under Processing")->text('Under Processing'),
									$ui->option()->value("Rejected")->text('Rejected'),
									$ui->option()->value("Closed")->text('Closed')
								  )
							)
				   ->show();
		$c2->close();
	$inputRow4->close();
?>
<center>
<?
	$ui->button()
		->value('Submit')
		->submit(true)
		->id('complaint')
		->uiType('primary')
		->show();

	$form->close();

	$box->close();
	
	$column2->close();
	
	$row->close();
?>
</center>