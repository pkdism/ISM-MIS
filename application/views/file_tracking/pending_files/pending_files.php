<?php
	$ui = new UI();
	if($res->num_rows() == 0){
		$ui->callout()
			 ->uiType('info')
			 ->title('No Files Pending:)')
			 ->show();
		return;
	}
?>
<?php
	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();

	$column2 = $ui->col()->width(9)->open();
	$box = $ui->box()
				->title('Pending Files')
				->solid()
				->uiType('primary')
				->open();

			//content
	$table = $ui->table()->hover()->bordered()
				->sortable()->searchable()->paginated()
				->open();
?>
		<thead>
			<tr>
				<th>File No</th>
				<th>File Subject</th>
				<th>Sent By</th>
				<th>File Operations</th>
			</tr>
		</thead>
<?php
		foreach($res->result() as $row)
		{
?>
		<tr>
			<td><?php if ($row->file_no) echo $row->file_no; else echo "File No. not yet generated"; ?></td>
			<td><?php echo $row->file_subject; ?></td>
			<td><?php echo $row->salutation.' '.$row->first_name.' '.$row->middle_name.' '.$row->last_name; ?></td>
			<td>
				<center>
				<a href="<?php echo site_url("file_tracking/send_running_file/index/".$row->file_id."/".$row->file_subject."/".$row->sent_by_emp_id); ?>">
				   <?php $ui->button()
							->value('Forward This File')
							->id('submit')
							->uiType('primary')
							->submit()
							->name('submit')
							->width(6)
							->show(); ?></a>
				<a href="<?php echo site_url("file_tracking/close_file/index/".$row->file_id); ?>">
				   <?php $ui->button()
							->value('Close File')
							->id('submit')
							->uiType('primary')
							->submit()
							->name('submit')
							->width(6)
							->show(); ?></a>
				</center>
				</td>
		</tr>
<?php
		}
	$table->close();
	$column2->close();
	$outer_row->close();
?>
