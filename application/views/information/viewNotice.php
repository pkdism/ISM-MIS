<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();

	$column2 = $ui->col()->width(10)->open();
		$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("file"))
				   ->title("Notices")
				   ->tab("current", "Current Notices", true)
				   ->tab("archived", "Archived Notices")
				   ->open();

			$tab1 = $ui->tabPane()->id("current")->active()->open();
			$flag=1;

				if($count_current_notice != 0){

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
									
									<a href="<?=base_url().'assets/files/information/notice/'.$notice->notice_path?>" download="<?=$notice->notice_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
								<?php 
									if ($notice->modification_value != 0)
									{
								?>
										  		<br>and</br>
										  		<a href="<?=base_url().'index.php/information/view_notice/prev/'.$notice->notice_id?>"><?=$ui->button()->mini()->uiType('primary')->value('Get Prev Version')->show(); echo'</a>';
									}
									echo'</td>
								</tr>';
					}
					$table->close();
				}
				else
				{
					$ui->callout()
					   ->uiType("info")
					   ->title("No Current Notice.")
					   ->desc("You have not any current notice to view.")
					   ->show();
				}
?>
<?php
			$tab1->close();
			$flag=2;
			$tab2 = $ui->tabPane()->id("archived")->open();

				if($count_archived_notice != 0){

					$table1 = $ui->table()->hover()->bordered()
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
					foreach($notices_archived as $key => $notice) 
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
									
									<a href="<?=base_url().'assets/files/information/notice/'.$notice->notice_path?>" download="<?=$notice->notice_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
								<?php 
									if ($notice->modification_value != 0  && $flag==1)
									{
								?>
										  		<br>and</br>
										  		<a href="<?=base_url().'index.php/information/view_notice/prev/'.$notice->notice_id?>"><?=$ui->button()->uiType('primary')->mini()->value('Get Prev Version')->show(); echo'</a>';
									}
									echo'</td>
								</tr>';
					}
					$table1->close();
				}
				else
				{
					$ui->callout()
					   ->uiType("info")
					   ->title("No Archived Notice.")
					   ->desc("You have not any Archived notice to view.")
					   ->show();
				}

		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
