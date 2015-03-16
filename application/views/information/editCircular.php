<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();

	$column2 = $ui->col()->width(10)->open();
		$tabBox1 = $ui->box()
				   ->icon($ui->icon("file"))
				   ->title("Circulars Posted By You")
				   ->uiType('primary')
				   ->solid()
				   //->tab("current", "Current Circulars", true)
				   ->open();

			//$tab1 = $ui->tabPane()->id("current")->active()->open();
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
									
									<a href="<?=base_url().'assets/files/information/circular/'.$circular->circular_path?>" download="<?=$circular->circular_path?>"><?=$ui->button()->icon($ui->icon("download"))->uiType('primary')->value('Download')->mini()->show();?></a>
								<?php 
									
								?>
										  		<br>and</br>
										  		<a href="<?=base_url().'index.php/information/edit_circular/index/'.$auth_id.'/'.$circular->circular_id?>"><?=$ui->button()->uiType('primary')->mini()->icon($ui->icon("edit"))->value('Edit')->show(); echo'</a>';
									
									echo'</td>
								</tr>';
					}
					$table->close();
				
		//$tab1->close();

		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
