<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();

	$column2 = $ui->col()->width(10)->open();
		$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("file"))
				   ->title("Circulars")
				   ->tab("current", "Current Circulars", true)
				   ->tab("archived", "Archived Circulars")
				   ->open();

			$tab1 = $ui->tabPane()->id("current")->active()->open();
			$flag=1;

				if($count_current_circular != 0){

					$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>							
								<th>Circular Number</th>
								<th >Circular Subject</th>							
								<th>Posted On/ Edited On</th>
								<th >Issued By</th>
								<th>Revision Status</th>
								<th >Links</th>
							</tr>
						</thead>
<?php
					foreach($circulars as $key => $circular) 
					{
?>
						<tr>
									
									<td align="center"><?=$circular->circular_no?></td>
									<td><?=$circular->circular_sub ?></td>
									<td align="center"><?=date('d M Y g:i a',strtotime($circular->posted_on)+19800)?></td>
									<td align="center"><?=$circular->salutation.' '.$circular->first_name.' '.$circular->middle_name.' '.$circular->last_name.'<br>('.$circular->auth_name?>)</td>
									<td align="center">
								<?php
									if ($circular->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$circular->modification_value.'</font>';
								?>
									</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/information/circular/'.$circular->circular_path?>" download="<?=$circular->circular_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
								<?php 
									if ($circular->modification_value != 0)
									{
								?>
										  		<br>and</br>
										  		<a href="<?=base_url().'index.php/information/view_circular/prev/'.$circular->circular_id?>"><?=$ui->button()->uiType('primary')->mini()->value('Get Prev Version')->show(); echo'</a>';
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
					   ->title("No Current Circular.")
					   ->desc("You have not any current circular to view.")
					   ->show();
				}
?>
<br/>
<?php
			$tab1->close();
			$flag=2;
			$tab2 = $ui->tabPane()->id("archived")->open();

				if($count_archived_circular != 0){

					$table1 = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>							
								<th>Circular Number</th>
								<th >Circular Subject</th>							
								<th>Posted On/ Edited On</th>
								<th >Issued By</th>
								<th>Revision Status</th>
								<th >Links</th>
							</tr>
						</thead>
<?php
					foreach($circulars_archived as $key => $circular) 
					{
?>
						<tr>
									
									<td align="center"><?=$circular->circular_no?></td>
									<td><?=$circular->circular_sub ?></td>
									<td align="center"><?=date('d M Y g:i a',strtotime($circular->posted_on)+19800)?></td>
									<td align="center"><?=$circular->salutation.' '.$circular->first_name.' '.$circular->middle_name.' '.$circular->last_name.'<br>('.$circular->auth_name?>)</td>
									<td align="center">
								<?php
									if ($circular->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$circular->modification_value.'</font>';
								?>
									</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/information/circular/'.$circular->circular_path?>" download="<?=$circular->circular_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
								<?php 
									if ($circular->modification_value != 0  && $flag==1)
									{
								?>
										  		<br>and</br>
										  		<a href="<?=base_url().'index.php/information/view_circular/prev/'.$circular->circular_id?>"><?=$ui->button()->uiType('primary')->value('Get Prev Version')->show(); echo'</a>';
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
					   ->title("No Archived Circular.")
					   ->desc("You have not any Archived circular to view.")
					   ->show();
				}

		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
