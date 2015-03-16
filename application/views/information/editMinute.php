<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	
	$column2 = $ui->col()->width(12)->open();
		$tabBox1 = $ui->box()
				   ->uiType('primary')
				   ->solid()
				   ->icon($ui->icon("file"))
				   ->title("Minutes Posted By You")
				  // ->tab("current", "Current Minutes", true)
				   ->open();

			//$tab1 = $ui->tabPane()->id("current")->active()->open();
					$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>							
								<th>Minutes Number</th>
								<th >Meeting Type</th>
								<th >Meeting Date</th>	
								<th >Meeting Type</th>						
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
									
									<a href="<?=base_url().'assets/files/information/minute/'.$minute->minutes_path?>" download="<?=$minute->minutes_path?>"><?=$ui->button()->mini()->uiType('primary')->icon($ui->icon("download"))->value('Download')->show();?></a>
								<?php 
									
								?>
										  		<br>and</br>
										  		<a href="<?=base_url().'index.php/information/edit_minute/index/'.$auth_id.'/'.$minute->minutes_id?>"><?=$ui->button()->mini()->uiType('primary')->icon($ui->icon("edit"))->value('Edit')->show(); echo'</a>';
									
									echo'</td>
								</tr>';
					}
					$table->close();
				
//$tab1->close();
		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
