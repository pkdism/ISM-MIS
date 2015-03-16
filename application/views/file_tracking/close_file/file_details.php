<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(2)->open();
	$column1->close();

	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
				->title('Close File')
				->solid()
				->uiType('primary')
				->open();
	$table = $ui->table()->hover()->bordered()->open();
		echo '<tr>
						<th>File No</th>
						<th>File Subject</th>
						<th>Track Number</th>
						<th>Click to confirm</th>
					</tr>';
		foreach($res->result() as $row)
		{
?>
			<tr>
				<td><?php echo $row->file_no;?></td>
				<td><?php echo $row->file_subject;?></td>
				<td><?php echo $row->track_num;?></td>
				<td>
					<center>
					<?php
						$ui->button()
							->value('Confirm')
							->id('close')
							->uiType('primary')
							->show();
					?>
					</center>
				</td>
			</tr>
<?php
		}
	$table->close();
	$box->close();
	$column2->close();
	$outer_row->close();
?>

<script charset="utf-8">
	$('#close').click(function(){
		window.location.href=site_url('file_tracking/close_file/insert_close_details/'+(<?php echo $file_id; ?>));
	});
</script>
