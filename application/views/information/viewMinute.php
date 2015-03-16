<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	
	$column2 = $ui->col()->width(12)->open();
		$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("file"))
				   ->title("Minutes")
				   ->tab("current", "Current Minutes", true)
				   ->tab("archived", "Archived Minutes")
				   ->open();

			$tab1 = $ui->tabPane()->id("current")->active()->open();
			$flag=1;

				if($count_current_minutes != 0){

					$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>							
								<th>Minutes Number</th>
								<th >Meeting Type</th>
								<th >Meeting Date</th>	
								<th >Meeting Place</th>						
								<th>Posted On/ Edited On</th>
								<th >Issued By</th>
								<th>Revision Status</th>
								<th >Links</th>
							</tr>
						</thead>
<?php
					foreach($minutes as $key => $minute) 
					{
?>
						<tr>
									
									<td align="center"><?=$minute->minutes_no?></td>
									<td align="center"><?=$minute->meeting_type?></td>
							<td align="center"><?=date_format( date_create($minute->date_of_meeting),'d M Y')?></td>
							<td align="center"><?=$minute->place_of_meeting?></td>
							<td align="center"><?=$minute->salutation.' '.$minute->first_name.' '.$minute->middle_name.' '.$minute->last_name.'</br>('.$minute->auth_name?>)</td>
							<td align="center"><?=date('d M Y g:i a',strtotime($minute->posted_on)+19800)?></td>				
							<td align="center">
							<?php
								if ($minute->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised '.$minute->modification_value.'</font>';
							?>
								</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/information/minute/'.$minute->minutes_path?>" download="<?=$minute->minutes_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
								<?php 
									if ($minute->modification_value != 0)
									{
								?>
										  		<br>and</br>
										  		<a href="<?=base_url().'index.php/information/view_minute/prev/'.$minute->minutes_id?>"><?=$ui->button()->uiType('primary')->mini()->value('Get Prev Version')->show(); echo'</a>';
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
					   ->title("No Current Minutes.")
					   ->desc("You have not any current minutes to view.")
					   ->show();
				}
?>

<?php
			$tab1->close();
			$flag=2;
			$tab2 = $ui->tabPane()->id("archived")->open();

				if($count_archived_minutes != 0){

					$table1 = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>							
								<th>Minutes Number</th>
								<th >Meeting Type</th>
								<th >Meeting Date</th>	
								<th >Meeting Place</th>						
								<th>Posted On/ Edited On</th>
								<th >Issued By</th>
								<th>Revision Status</th>
								<th >Links</th>
							</tr>
						</thead>
<?php
					foreach($minutes_archived as $key => $minute) 
					{
?>
						<tr>
									
									<td align="center"><?=$minute->minutes_no?></td>
									<td align="center"><?=$minute->meeting_type?></td>
							<td align="center"><?=date_format( date_create($minute->date_of_meeting),'d M Y')?></td>
							<td align="center"><?=$minute->place_of_meeting?></td>
							<td align="center"><?=$minute->salutation.' '.$minute->first_name.' '.$minute->middle_name.' '.$minute->last_name.'</br>('.$minute->auth_name?>)</td>
							<td align="center"><?=date('d M Y g:i a',strtotime($minute->posted_on)+19800)?></td>				
							<td align="center">
							<?php
								if ($minute->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised '.$minute->modification_value.'</font>';
							?>
								</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/information/minute/'.$minute->minutes_path?>" download="<?=$minute->minutes_path?>"><?=$ui->button()->icon($ui->icon("download"))->uiType('primary')->mini()->value('Download')->show();?></a>
								<?php 
									if ($minute->modification_value != 0  && $flag==1)
									{
								?>
										  		<br>and</br>
										  		<a href="<?=base_url().'index.php/information/view_minute/prev/'.$minute->minutes_id?>"><?=$ui->button()->uiType('primary')->mini()->value('Get Prev Version')->show(); echo'</a>';
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
					   ->title("No Archived Minutes.")
					   ->desc("You have not any Archived minutes to view.")
					   ->show();
				}

		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
