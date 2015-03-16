<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();

	$column2 = $ui->col()->width(10)->open();
		$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("file"))
				   ->title("Track File")
				   ->tab("sent", "Track Sent Files", true)
				   ->tab("track_num_tab", "Track Files by Track Number")
				   ->open();

			$tab1 = $ui->tabPane()->id("sent")->active()->open();

				if($total_rows != 0){

					$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>
									<th>File No.</th>
									<th>File Subject</th>
									<th>File Track Number</th>
									<th>Sent To</th>
									<th>Sent On</th>
									<th>Current Status</th>
									<th>File Operations</th>
							</tr>
						</thead>
<?php
					$sno=1;
					while ($sno <= $total_rows)
					{
?>
						<tr>
							<td><?php if ($data_array[$sno][1]) echo $data_array[$sno][1]; else echo "(File No. not yet generated)"?></td>
							<td><?php echo $data_array[$sno][3];?></td>
							<td><?php echo $data_array[$sno][4];?></td>
							<td><?php echo $data_array[$sno][5];?></td>
							<td><?php echo $data_array[$sno][7];?></td> 
							<td><?php if ($data_array[$sno][6]) echo "Closed"; else echo "Active"; ?></td>
							<td>
							<center>
							<?php	$ui->button()
										->value('Track File')
										->id('submit'.$sno)
										->uiType('primary')
										->name('submit_track')
										->show(); 
							?>
							</center>
							</td>
						</tr>
<?php
						$sno++;
					}
					$table->close();
				}
				else
				{
					$ui->callout()
					   ->uiType("info")
					   ->title("No File sent by You.")
					   ->desc("You have not sent any file, track file by track number.")
					   ->show();
				}
?>
<br/>
<div id="move_details_of_sent_files">
</div>
<?php
			$tab1->close();

			$tab2 = $ui->tabPane()->id("track_num_tab")->open();
		   		 $ui->input()
					->placeholder('Enter track number')
					->type('text')
					->label('Track Number')
					->id('track_num')
					->name('track_num')
					->show();
?>
<center>
<?php
				 $ui->button()
					->value('Track File')
					->id('submit')
					->uiType('primary')
					->submit()
					->name('submit')
					->show();
?>
</center>
<br>
<div id="move_details_by_track_num">
</div>
<?php
//	$box2 = $ui->box()
//				->id('move_details_by_track_num')
//				->open();
?>
<?php
			$tab2->close();

		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
<script charset="utf-8">
	<?php
		$sno=1;
		while ($sno <= $total_rows)
		{
	?>
			var submit_id = '#submit'+<?php echo $sno; ?>;
			$(submit_id).click(function(){
				get_file_move_details_of_sent_files(<?php echo $data_array[$sno][4]; ?>);
			});
	<?php
			$sno++;
		}
	?>
</script>
