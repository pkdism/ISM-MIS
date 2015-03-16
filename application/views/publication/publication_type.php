<?php
	$ui =  new UI();

	if ($type==1 || $type==2)
	{
		$row = $ui->row()->open();
		$row1 = $ui->row()->open();

			$innerColumn4 = $ui->col()->width(6)->open();
				$ui->input()->label('Issue No.')->name('issue_no')->required()->show();
			$innerColumn4->close();

			$innerCol2 = $ui->col()->width(6)->open();
				$ui->input()->label('Volume No.')->name('vol_no')->required()->show();
			$innerCol2->close();

		$row1->close();

		$row3 = $ui->row()->open();

			$innerColumn5 = $ui->col()->width(6)->open();
				$ui->input()->label('Page Range')->name('page_no')->required()->show();
			$innerColumn5->close();
			$innerColumn6 = $ui->col()->width(6)->open();
				$ui->textarea()->label('Any other informations')->name("other_info")
				   ->placeholder("Any other details")->required()->show();
			$innerColumn6->close();

		$row3->close();

		$Col = $ui->col()->width(4)->open();
		$Col->close();

		$Col1 =  $ui->col()->width(4)->open();
			$row5 = $ui->row()->open();
			$ui->input()->id('num_of_authors')->label('No. of Authors')->name('no_of_authors')
			   ->required()->placeholder('No. of Authors')->extras(' onkeyup="get_authors(this.value)" ')->show();
			$row5->close();
		$Col1->close();

		$row->close();
		$row2 = $ui->col()->id('num_author')->width(12)->open();
		$row2->close();

	}

	if ($type==3 || $type==4)
	{
		$row = $ui->row()->open();
		$row1 = $ui->row()->open();

			$innerColumn1 = $ui->col()->width(6)->open();
				$ui->input()->label('Name of Conference')->name('publication_name')->required()->show();
			$innerColumn1->close();

			$innerColumn2 = $ui->col()->width(6)->open();
				$ui->input()->label('Venue')->name('venue')->required()->show();
			$innerColumn2->close();

		$row1->close();

		$row3 = $ui->row()->open();

			$innerColumn6 = $ui->col()->width(6)->open();
				$ui->input()->label('Page Range')->name('page_no')->required()->show();
			$innerColumn6->close();
			$innerColumn5 = $ui->col()->width(6)->open();
				$ui->textarea()->label('Any other informations')->name("other_info")
				   ->placeholder("Any other details")->required()->show();
			$innerColumn5->close();

		$row3->close();

		$Col = $ui->col()->width(4)->open();
		$Col->close();

		$Col1 =  $ui->col()->width(4)->open();
			$row5 = $ui->row()->open();
			$ui->input()->id('num_of_authors')->label('No. of Authors')->name('no_of_authors')
			   ->required()->placeholder('No. of Authors')->extras(' onkeyup="get_authors(this.value)" ')->show();
			$row5->close();
		$Col1->close();
		$row->close();

		$row2 = $ui->col()->id('num_author')->width(12)->open();
		$row2->close();


	}


	if ($type==5)
	{
		$row = $ui->row()->open();
		$row1 = $ui->row()->open();

			$innerColumn1 = $ui->col()->width(6)->open();
				$ui->input()->label('Publisher')->name('publisher')->required()->show();
			$innerColumn1->close();
			$innerCol2 = $ui->col()->width(6)->open();
				$ui->input()->label('Edition')->name('edition')->required()->show();
			$innerCol2->close();

		$row1->close();

		$Col = $ui->col()->width(4)->open();
		$Col->close();

		$Col1 =  $ui->col()->width(4)->open();
			$row5 = $ui->row()->open();
			$ui->input()->id('num_of_authors')->label('No. of Authors')->name('no_of_authors')
			   ->required()->placeholder('No. of Authors')->extras(' onkeyup="get_authors(this.value)" ')->show();
			$row5->close();
		$Col1->close();

		$row->close();
		$row2 = $ui->col()->id('num_author')->width(12)->open();
		$row2->close();
	}
	if ($type==6)
	{
		$row = $ui->row()->open();
		$row1 = $ui->row()->open();

			$innerColumn4 = $ui->col()->width(6)->open();
				$ui->input()->label('Publisher')->name('publisher')->required()->show();
			$innerColumn4->close();

			$innerCol2 = $ui->col()->width(6)->open();
				$ui->input()->label('Chapter Name')->name('chapter_name')->required()->show();
			$innerCol2->close();

		$row1->close();

		$row2 = $ui->row()->open();

			$innerColumn4 = $ui->col()->width(6)->open();
				$ui->input()->label('Chapter no.')->name('chapter_no')->required()->show();
			$innerColumn4->close();

			$innerColumn5 = $ui->col()->width(6)->open();
				$ui->textarea()->label('Any other informations')->name("other_info")
				   ->placeholder("Any other details")->required()->show();
			$innerColumn5->close();

		$row2->close();

		$Col = $ui->col()->width(4)->open();
		$Col->close();

		$Col1 =  $ui->col()->width(4)->open();
			$row5 = $ui->row()->open();
			$ui->input()->id('num_of_authors')->label('No. of Authors')->name('no_of_authors')
			   ->required()->placeholder('No. of Authors')->extras(' onkeyup="get_authors(this.value)" ')->show();
			$row5->close();
		$Col1->close();

		$row->close();
		$row2 = $ui->col()->id('num_author')->width(12)->open();
		$row2->close();
	}
?>

<script>
	$('#date').datepicker({ format: 'dd-mm-yyyy', autoclose: true, todayBtn: 'linked'});
</script>