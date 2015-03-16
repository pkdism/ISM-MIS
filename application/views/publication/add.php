<?php
	$ui = new UI();
	$outRow = $ui->row()->open();
	$column = $ui->col()->width(2)->open();
	$column->close();

	$column1 = $ui->col()->width(8)->open();
	$row = $ui->row()->open();
	$leftMargin = $ui->col()->width(1)->open();
			$leftMargin->close();
	$box = $ui->box()
			  ->id('publication_wrapper')
			  ->title('Add new Publication')
			  ->solid()
			  ->uiType('primary')
			  ->open();
	$form = $ui->form()->action('publication/publication/addPublication')->open();
	
	$inputRow1 = $ui->row()->open();
	$Col1 = $ui->col()->width(6)->open();
		$ui->input()->label('Title')->name('title')->required()->show();
	$Col1->close();
	$Col2 =  $ui->col()->width(6)->open();
		$ui->select()
		   ->label('Type of Publcation')
		   ->id('publication_type')
		   ->name('publication_type')
		   ->required()
		   ->options(array(
				$ui->option()->value()->text("Select"),
				$ui->option()->value(1)->text("National Journal"),
				$ui->option()->value(2)->text("International Journal"),
				$ui->option()->value(3)->text("National Conference"),
				$ui->option()->value(4)->text("International Conference"),
				$ui->option()->value(5)->text("Book"),
				$ui->option()->value(6)->text("Book Chapter")
			))
		   ->show();

	$Col2->close();
	$innerCol1 = $ui->col()->id("publication_name_one")->width(6)->open();
				$ui->input()->label('Name of Jorunal<sub>*</sub>')->name('publication_name')->show();
			$innerCol1->close();
	$innerColumn3 = $ui->col()->id("date_picker_one")->width(6)->open();
				$ui->datePicker()->label('Date')->id('date')
				   ->name('begin_date')->placeholder("dd-mm-yyyy")
				   ->dateFormat('dd-mm-yyyy')->show();
	$innerColumn3->close();
	$innerColumn4 = $ui->col()->id("isbn_first")->width(6)->open();
				$ui->input()->label('ISBN No.')->name('isbn_no')->show();
			$innerColumn4->close();
	$innerColumn3 = $ui->col()->id("date_picker_the")->width(6)->open();
				$ui->datePicker()->label('Begin date')->name('begin_date')->placeholder("dd-mm-yyyy")
						->dateFormat('dd-mm-yyyy')->show();
	$innerColumn3->close();
	$innerColumn4 = $ui->col()->id("date_picker_two")->width(6)->open();
				$ui->datePicker()->label('End date')->name('end_date')->placeholder("dd-mm-yyyy")
						->dateFormat('dd-mm-yyyy')->show();
	$innerColumn4->close();


	$inputRow1->close();
	

	$row2 = $ui->col()->id('pub_type')->width(12)->open();	
	
	$row2->close();

	$row3 = $ui->row()->open();
	?><center><?php
	$ui->button()->name('Submit')->value('Submit')->submit(true)->uiType('primary')->show();
	?></center><?php
	$row3->close();
	$form->close();
	$box->close();
	$row->close();

	$column1->close();
	$outRow->close();

?>
<script charset="utf-8">
	$("#publication_type").on('change', function() {
		get_publication_type(this.value);
		if (this.value == 1 || this.value == 2)
		{
			$('#date_picker_one').show();
			$('#publication_name_one').show();
			$('#date_picker_the').hide();
			$('#date_picker_two').hide();
			$('#isbn_first').hide();
		}
		else if(this.value==3||this.value==4)
		{
			$('#date_picker_one').hide();
			$('#publication_name_one').hide();
			$('#date_picker_the').show();
			$('#date_picker_two').show();
			$('#isbn_first').hide();
		}
		else
		{
			$('#date_picker_one').show();
			$('#publication_name_one').hide();
			$('#date_picker_the').hide();
			$('#date_picker_two').hide();
			$('#isbn_first').show();
		}
	});
	$(window).load(function(){
		$('#publication_name_one').hide();
		$('#date_picker_one').hide();
		$('#date_picker_two').hide();
		$('#date_picker_the').hide();
		$('#isbn_first').hide();
	});
	//$("#date")
</script>