<?php
	$ui = new UI();
	$row = $ui->row()->open();

	
	$innerRow1 = $ui->row()->open();

		$leftCol = $ui->col()->width(4)->open();
			$ui->input()->label('First Name')->name('author_'.$author_no.'_fname')->required()->show();
		$leftCol->close();
		$middleCol = $ui->col()->width(4)->open();
			$ui->input()->label('Middle Name')->name('author_'.$author_no.'_mname')->required()->show();
		$middleCol->close();
		$rightCol = $ui->col()->width(4)->open();
			$ui->input()->label('Last Name')->name('author_'.$author_no.'_lname')->required()->show();
		$rightCol->close();

	$innerRow1->close();

	$innerRow2 = $ui->row()->open();

		$leftCol1 = $ui->col()->width(4)->open();
			$ui->input()->label('Email Id')->name('author_'.$author_no.'_email')->required()->show();
		$leftCol1->close();
		$middleCol1 = $ui->col()->width(4)->open();
			$ui->input()->label('Institution')->name('author_'.$author_no	.'_institution')->required()->show();
		$middleCol1->close();
		$rightCol1 = $ui->col()->width(4)->open();
			$ui->input()->label('Any other information')->name('other')->required()->show();
		$rightCol1->close();

	$innerRow2->close();
	$row->close();
?>