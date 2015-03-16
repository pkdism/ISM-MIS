<?php 
	$ui = new UI();
//echo form_open('complaint/register_complaint/insert');   
	
	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->title('On Line Complaint Form')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	$form = $ui->form()->action('complaint/register_complaint/insert')->open();

	$inputRow1 = $ui->row()->open();
		$ui->select()
		   ->label('Type of Complaint')
		   ->name('type')
		   ->required()
		   ->options(array( $ui->option()->value('""')->text('Select'),
							$ui->option()->value("Civil")->text('Civil'),
							$ui->option()->value("Electrical")->text('Electrical'),
							$ui->option()->value("Internet")->text('Internet'),
							$ui->option()->value("Mess")->text('Mess'),
							$ui->option()->value("Sanitary")->text('Sanitary')
						  )
					)
		   ->width(6)
		   ->show();
		$ui->select()
		   ->label('Location')
		   ->name('location')
		   ->id('location')
		   ->required()
		   ->options(array( $ui->option()->value('""')->text('Select'),
							$ui->option()->value("Department")->text('Department'),
							$ui->option()->value("Office")->text('Office'),
							$ui->option()->value("Residence")->text('Residence'),
							$ui->option()->value("Amber Hostel")->text('Amber Hostel'),
							$ui->option()->value("Diamond Hostel")->text('Diamond Hostel'),
							$ui->option()->value("Emerald Hostel")->text('Emerald Hostel'),
							$ui->option()->value("International Hostel")->text('International Hostel'),
							$ui->option()->value("Jasper Hostel")->text('Jasper Hostel'),
							$ui->option()->value("JRF Hostel")->text('JRF Hostel'),
							$ui->option()->value("Opal Hostel")->text('Opal Hostel'),
							$ui->option()->value("Ruby")->text('Ruby'),
							$ui->option()->value("Ruby Annex")->text('Ruby Annex'),
							$ui->option()->value("Shanti Bhawan")->text('Shanti Bhawan'),
							$ui->option()->value("Sapphire Hostel")->text('Sapphire Hostel'),
							$ui->option()->value("Topaz Hostel")->text('Topaz Hostel'),
							$ui->option()->value("Others")->text('Others')
						  )
					)
		   ->width(6)
		   ->show();
	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		$ui->textarea()->placeholder('Location Details')->label('Location Details')->name('locationDetails')->id('locationDetails')->required()
		   ->width(6)
		   ->show();
		$ui->textarea()->label('Problem Details')->name("problemDetails")->placeholder("Problem Details")->required()
		   ->width(6)
		   ->show();
	$inputRow2->close();

	$ui->input()->type('text')->placeholder('Time of Availability')->label('Time of Availability')->name('time')->required()->show();
?>
<center>
<?php
	$ui->button()
		->value('Submit')
		->submit(true)
		->id('complaint')
		->uiType('primary')
		->show();
	//echo form_close(); 
	$form->close();

	$box->close();
	
	$column2->close();
	
	$row->close();
?>
</center>