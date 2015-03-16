<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();

	$column2 = $ui->col()->width(10)->open();
	$tabBox1 = $ui->box()
				   ->icon($ui->icon("file"))
				   ->uiType('primary')
				   ->solid()
				   ->title("Notices Posted By You")
				   //->tab("current", "Current Notices", true)
				   ->open();

			//$tab1 = $ui->tabPane()->id("current")->active()->open();
			$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
			<thead>
				<tr>							
					<th>Notice Number</th>
					<th >Notice Subject</th>							
					<th>Posted On/ Edited On</th>
					<th >Issued By</th>
					<th>Revision Status</th>
					<th >Links</th>
				</tr>
			</thead>
<?php
			foreach($notices as $key => $notice) 
			{
?>
				<tr>
							
							<td align="center"><?=$notice->notice_no?></td>
							<td><?=$notice->notice_sub ?></td>
							<td align="center"><?=date('d M Y g:i a',strtotime($notice->posted_on)+19800)?></td>
							<td align="center"><?=$notice->salutation.' '.$notice->first_name.' '.$notice->middle_name.' '.$notice->last_name.'<br>('.$notice->auth_name?>)</td>
							<td align="center">
						<?php
							if ($notice->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$notice->modification_value.'</font>';
						?>
							</td>
							<td align="center">
							
							<a href="<?=base_url().'assets/files/information/notice/'.$notice->notice_path?>" download="<?=$notice->notice_path?>"><?=$ui->button()->icon($ui->icon("download"))->uiType('primary')->mini()->value('Download')->show();?></a>
						<?php 
							
						?>
								  		<br>and</br>
								  		<a href="<?=base_url().'index.php/information/edit_notice/index/'.$auth_id.'/'.$notice->notice_id?>"><?=$ui->button()->icon($ui->icon("edit"))->uiType('primary')->mini()->value('Edit')->show(); echo'</a>';
							
							echo'</td>
						</tr>';
			}
					$table->close();
				//$tab1->close();
				$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
