<?php
	$ui =  new UI();
	$col = $ui->col()->width(2)->open();
	$col->close();
	$form = $ui->form()->action('publication/publication/submit_edit')->open();
	$col11 = $ui->col()->width(8)->open();
	$box = $ui->box()->uiType('primary')->solid()->title('Edit Publication')->open();
		if ($publication['type_id']==1 || $publication['type_id']==2)
		{
			$row1 = $ui->row()->open();

				$Col1 = $ui->col()->width(6)->open();
					$ui->input()->label('Title of Journal')->name('title')->value($publication['name'])->required()->show();
				$Col1->close();

				$innerCol1 = $ui->col()->width(6)->open();
					$ui->input()->label('Name of Jorunal')->name('publication_name')->value($publication['name'])->show();
				$innerCol1->close();

			$row1->close();

			$row2 = $ui->row()->open();

				$innerCol2 = $ui->col()->width(6)->open();
					$ui->input()->label('Volume No.')->name('vol_no')->value($publication['vol_no'])->show();
				$innerCol2->close();

				$innerColumn3 = $ui->col()->width(6)->open();
					$ui->datePicker()->label('Date')->id('date')
					   ->name('begin_date')->placeholder("dd-mm-yyyy")
					   ->value($publication['begin_date'])
					   ->dateFormat('dd-mm-yyyy')->show();
				$innerColumn3->close();				

			$row2->close();

			$row3 = $ui->row()->open();

				$innerColumn4 = $ui->col()->width(6)->open();
					$ui->input()->label('Issue No.')->name('issue_no')->value($publication['issue_no'])->show();
				$innerColumn4->close();

				$innerColumn5 = $ui->col()->width(6)->open();
					$ui->input()->label('Page Range')->name('page_no')->value($publication['page_no'])->show();
				$innerColumn5->close();

			$row3->close();

			$row4 = $ui->row()->open();

				$innerColumn6 = $ui->col()->width(6)->open();
					$ui->textarea()->label('Any other informations')->name("other_info")
					   ->placeholder("Any other details")->required()->value($publication['other_info'])->show();
				$innerColumn6->close();

			$row4->close();

		}

		if ($publication['type_id']==3 || $publication['type_id']==4)
		{
			$row1 = $ui->row()->open();

				$Col1 = $ui->col()->width(6)->open();
					$ui->input()->label('Title')->name('title')->required()->value($publication['title'])->show();
				$Col1->close();

				$innerColumn1 = $ui->col()->width(6)->open();
					$ui->input()->label('Name of Conference')->name('publication_name')->value($publication['name'])->show();
				$innerColumn1->close();

			$row1->close();

			$row2 = $ui->row()->open();

				$innerColumn2 = $ui->col()->width(6)->open();
					$ui->input()->label('Venue')->name('venue')->value($publication['venue'])->show();
				$innerColumn2->close();

				$innerColumn3 = $ui->col()->width(6)->open();
					$ui->datePicker()->label('Begin date')->name('begin_date')->placeholder("dd-mm-yyyy")
							->dateFormat('yy-mm-dd')->value($publication['begin_date'])->show();
				$innerColumn3->close();

			$row2->close();

			$row3 = $ui->row()->open();

				$innerColumn4 = $ui->col()->width(6)->open();
					$ui->datePicker()->label('End date')->name('end_date')->placeholder("dd-mm-yyyy")
							->dateFormat('yy-mm-dd')->value($publication['end_date'])->show();
				$innerColumn4->close();

				$innerColumn6 = $ui->col()->width(6)->open();
					$ui->input()->label('Page Range')->name('page_no')->required()->show();
				$innerColumn6->close();

			$row3->close();

			$row4 = $ui->row()->open();

				$innerColumn5 = $ui->col()->width(6)->open();
					$ui->textarea()->label('Any other informations')->name("other_info")
					   ->placeholder("Any other details")->required()->value($publication['other_info'])->show();
				$innerColumn5->close();

			$row4->close();

		}


		if ($publication['type_id']==5)
		{
			$row1 = $ui->row()->open();

				$Col1 = $ui->col()->width(6)->open();
					$ui->input()->label('Title of Book')->name('title')->value($publication['title'])->required()->show();
				$Col1->close();

				$innerColumn1 = $ui->col()->width(6)->open();
					$ui->input()->label('Publisher')->name('publisher')->value($publication['publisher'])->show();
				$innerColumn1->close();				

			$row1->close();

			$row2 = $ui->row()->open();

				$innerCol2 = $ui->col()->width(6)->open();
					$ui->input()->label('Edition')->name('edition')->value($publication['edition'])->show();
				$innerCol2->close();

				$innerColumn3 = $ui->col()->width(6)->open();
					$ui->datePicker()->label('Date')->id('date')
					   ->name('begin_date')->placeholder("dd-mm-yyyy")->value($publication['begin_date'])
					   ->dateFormat('dd-mm-yyyy')->show();
				$innerColumn3->close();

			$row2->close();

			$row3 = $ui->row()->open();

				$innerColumn4 = $ui->col()->width(6)->open();
					$ui->input()->label('ISBN No.')->name('isbn_no')->value($publication['isbn_no'])->show();
				$innerColumn4->close();

			$row3->close();
		}
		if ($publication['type_id']==6)
		{
			$row1 = $ui->row()->open();

				$Col1 = $ui->col()->width(6)->open();
					$ui->input()->label('Title of Book')->name('title')->value($publication['title'])->required()->show();
				$Col1->close();

				$innerColumn4 = $ui->col()->width(6)->open();
					$ui->input()->label('Publisher')->name('publisher')->value($publication['publisher'])->show();
				$innerColumn4->close();

			$row1->close();

			$row2 = $ui->row()->open();

				$innerCol2 = $ui->col()->width(6)->open();
					$ui->input()->label('Chapter Name')->name('chapter_name')->value($publication['chapter_name'])->show();
				$innerCol2->close();

				$innerColumn3 = $ui->col()->width(6)->open();
					$ui->datePicker()->label('Date')->id('date')
					   ->name('begin_date')->placeholder("dd-mm-yyyy")->value($publication['begin_date'])
					   ->dateFormat('dd-mm-yyyy')->show();
				$innerColumn3->close();

			$row2->close();

			$row3 = $ui->row()->open();

				$innerColumn4 = $ui->col()->width(6)->open();
					$ui->input()->label('Chapter no.')->name('chapter_no')->value($publication['chapter_no'])->show();
				$innerColumn4->close();


				$innerColumn4 = $ui->col()->width(6)->open();
					$ui->input()->label('ISBN No.')->name('isbn_no')->value($publication['isbn_no'])->show();
				$innerColumn4->close();

			$row3->close();

			$row4 = $ui->row()->open();

				$innerColumn5 = $ui->col()->width(6)->open();
					$ui->textarea()->label('Any other informations')->name("other_info")
					   ->placeholder("Any other details")->value($publication['other_info'])->show();
				$innerColumn5->close();

			$row4->close();
		}
	$ui->button()->value('Edit')->submit(true)->id('Edit')->uiType('primary')->show();
	$box->close();
	$col11->close();
	$form->close();
?>

<script>
	$('#date').datepicker({ format: 'dd-mm-yyyy', autoclose: true, todayBtn: 'linked'});
</script>