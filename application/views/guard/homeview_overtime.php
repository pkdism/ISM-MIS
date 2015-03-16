<div id="print">
<?php
echo '<center>';
if(isset($details_of_guards_at_a_post))
{
	$postname='';
	foreach($details_of_guards_at_a_post as $row)
	{
		$postname = $row->postname;
		break;
	}
	$ui = new UI();
	$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Details of Guards at '.$postname.' Post')
				 ->solid()
				 ->open();
		$boxesRow = $ui->row()
					   ->open();
			
			$aboxCol = $ui->col()
					   ->width(1)
					   ->t_width(2)
					   ->m_width(2)
					   ->open();
		    $aboxCol->close();
			$bboxCol = $ui->col()
					   ->width(10)
					   ->t_width(8)
					   ->m_width(8)
					   ->open();
	
				$table = $ui->table()->responsive()->hover()->bordered()->striped()->sortable()->paginated()->searchable()->open();

								echo '<tbody>
										<thead>
											<tr>
												<th><center>Guard Name</center></th>
												<th class="print-no-display">Photo</th>
												<th><center>Duration</center></th>
												<th><center>Duty Date</center></th>
											</tr>
										</thead>';
									foreach ($details_of_guards_at_a_post as $row)
									{
										if(ceil($row->from_time) == floor($row->from_time))
											$from_time = floor($row->from_time).':00';
										else
											$from_time = floor($row->from_time).':30';
										
										if(ceil($row->to_time) == floor($row->to_time))
											$to_time = floor($row->to_time).':00';
										else
											$to_time = floor($row->to_time).':30';
																 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$from_time.'-'.$to_time.'</center></td>	
																	<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>
																</tr>';
									}	
							    echo '</tbody>';
				$table->close();
			$bboxCol->close();
			$cboxCol = $ui->col()
					   ->width(1)
					   ->t_width(2)
					   ->m_width(2)
					   ->open();
		    $cboxCol->close();
			
		$boxesRow->close();
	$headingBox->close();

}

else if(isset($details_of_guards_at_a_date))
{
	$ui = new UI();
	$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Details of Guards on '.date('d M Y',strtotime($selectdate)+19800))
				 ->solid()
				 ->open();
		$boxesRow = $ui->row()
					   ->open();
			
			$aboxCol = $ui->col()
					   ->width(1)
					   ->t_width(2)
					   ->m_width(2)
					   ->open();
		    $aboxCol->close();
			$bboxCol = $ui->col()
					   ->width(10)
					   ->t_width(8)
					   ->m_width(8)
					   ->open();
	
				$table = $ui->table()->responsive()->hover()->bordered()->striped()->sortable()->paginated()->searchable()->open();

								echo '<tbody>
										<thead>
											<tr>
												<th><center>Post Name</center></th>
												<th><center>Guard Name</center></th>
												<th class="print-no-display">Photo</th>
												<th><center>Duration</center></th>
											</tr>
										</thead>';
									foreach ($details_of_guards_at_a_date as $row)
									{
										if(ceil($row->from_time) == floor($row->from_time))
											$from_time = floor($row->from_time).':00';
										else
											$from_time = floor($row->from_time).':30';
										
										if(ceil($row->to_time) == floor($row->to_time))
											$to_time = floor($row->to_time).':00';
										else
											$to_time = floor($row->to_time).':30';
																 
														   echo '<tr>
																	<td><center>'.$row->postname.'</center></td>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$from_time.'-'.$to_time.'</center></td>	
																</tr>';
									}	
							    echo '</tbody>';
				$table->close();
			$bboxCol->close();
			$cboxCol = $ui->col()
					   ->width(1)
					   ->t_width(2)
					   ->m_width(2)
					   ->open();
		    $cboxCol->close();
			
		$boxesRow->close();
	$headingBox->close();
}
else if(isset($details_of_guard_in_a_range))
{
	
	$ui = new UI();
	$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Duty of '.$details_of_a_guard['firstname'].' '.$details_of_a_guard['lastname'].' from '.date('d M Y',strtotime($fromdateg)+19800).' to '.date('d M Y',strtotime($todateg)+19800))
				 ->solid()
				 ->open();
		$boxesRow = $ui->row()
					   ->open();
			echo '<br><center><img src="'.base_url().'assets/images/guard/'.$details_of_a_guard['photo'].'" width="80px" height="80px"/></center></br>';
			echo '<b>Total Number of working hours '.$working_hours.'</b>';
			echo '<br>';
			$aboxCol = $ui->col()
					   ->width(1)
					   ->t_width(2)
					   ->m_width(2)
					   ->open();
		    $aboxCol->close();
			$bboxCol = $ui->col()
					   ->width(10)
					   ->t_width(8)
					   ->m_width(8)
					   ->open();
	
				$table = $ui->table()->responsive()->hover()->bordered()->striped()->sortable()->paginated()->searchable()->open();

								echo '<tbody>
										<thead>
											<tr>
												<th><center>Post Name</center></th>
												<th><center>Duty Date</center></th>
												<th><center>Duration</center></th>
											</tr>
										</thead>';
									foreach ($details_of_guard_in_a_range as $row)
									{
										if(ceil($row->from_time) == floor($row->from_time))
											$from_time = floor($row->from_time).':00';
										else
											$from_time = floor($row->from_time).':30';
										
										if(ceil($row->to_time) == floor($row->to_time))
											$to_time = floor($row->to_time).':00';
										else
											$to_time = floor($row->to_time).':30';
																 
														   echo '<tr>
																	<td><center>'.$row->postname.'</center></td>	
																	<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>
																	<td><center>'.$from_time.'-'.$to_time.'</center></td>	
																</tr>';
									}	
							    echo '</tbody>';
				$table->close();
			$bboxCol->close();
			$cboxCol = $ui->col()
					   ->width(1)
					   ->t_width(2)
					   ->m_width(2)
					   ->open();
		    $cboxCol->close();
			
		$boxesRow->close();
	$headingBox->close();

}

else if(isset($details_of_guards_in_a_range))
{
	$ui = new UI();
	$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Details of Guards from '.date('d M Y',strtotime($fromdate)+19800).' to '.date('d M Y',strtotime($todate)+19800))
				 ->solid()
				 ->open();
		$boxesRow = $ui->row()
					   ->open();
			$aboxCol = $ui->col()
					   ->width(1)
					   ->t_width(2)
					   ->m_width(2)
					   ->open();
		    $aboxCol->close();
			$bboxCol = $ui->col()
					   ->width(10)
					   ->t_width(8)
					   ->m_width(8)
					   ->open();
	
				$table = $ui->table()->responsive()->hover()->bordered()->striped()->sortable()->paginated()->searchable()->open();

								echo '<tbody>
										<thead>
											<tr>
												<th><center>Post Name</center></th>
												<th><center>Guard Name</center></th>
												<th class="print-no-display">Photo</th>
												<th><center>Duration</center></th>
												<th><center>Duty Date</center></th>
											</tr>
										</thead>';
									foreach ($details_of_guards_in_a_range as $row)
									{
										if(ceil($row->from_time) == floor($row->from_time))
											$from_time = floor($row->from_time).':00';
										else
											$from_time = floor($row->from_time).':30';
										
										if(ceil($row->to_time) == floor($row->to_time))
											$to_time = floor($row->to_time).':00';
										else
											$to_time = floor($row->to_time).':30';
																 
														   echo '<tr>
																	<td><center>'.$row->postname.'</center></td>	
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$from_time.'-'.$to_time.'</center></td>	
																	<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>
																</tr>';
									}	
							    echo '</tbody>';
				$table->close();
			$bboxCol->close();
			$cboxCol = $ui->col()
					   ->width(1)
					   ->t_width(2)
					   ->m_width(2)
					   ->open();
		    $cboxCol->close();
			
		$boxesRow->close();
	$headingBox->close();

}
else if(isset($details_of_guards_at_a_post_in_a_range))
{
	$postname='';
	foreach($details_of_guards_at_a_post_in_a_range as $row)
	{
		$postname = $row->postname;
		break;
	}
	$ui = new UI();
	$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Details of Guards from '.date('d M Y',strtotime($fromdatep)+19800).' to '.date('d M Y',strtotime($todatep)+19800).' at '.$postname.' Post')
				 ->solid()
				 ->open();
		$boxesRow = $ui->row()
					   ->open();
			$aboxCol = $ui->col()
					   ->width(1)
					   ->t_width(2)
					   ->m_width(2)
					   ->open();
		    $aboxCol->close();
			$bboxCol = $ui->col()
					   ->width(10)
					   ->t_width(8)
					   ->m_width(8)
					   ->open();
	
				$table = $ui->table()->responsive()->hover()->bordered()->striped()->sortable()->paginated()->searchable()->open();

								echo '<tbody>
										<thead>
											<tr>
												<th><center>Guard Name</center></th>
												<th class="print-no-display">Photo</th>
												<th><center>Duration</center></th>
												<th><center>Duty Date</center></th>
											</tr>
										</thead>';
									foreach ($details_of_guards_at_a_post_in_a_range as $row)
									{
										if(ceil($row->from_time) == floor($row->from_time))
											$from_time = floor($row->from_time).':00';
										else
											$from_time = floor($row->from_time).':30';
										
										if(ceil($row->to_time) == floor($row->to_time))
											$to_time = floor($row->to_time).':00';
										else
											$to_time = floor($row->to_time).':30';
																 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$from_time.'-'.$to_time.'</center></td>	
																	<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>
																</tr>';
									}	
							    echo '</tbody>';
				$table->close();
			$bboxCol->close();
			$cboxCol = $ui->col()
					   ->width(1)
					   ->t_width(2)
					   ->m_width(2)
					   ->open();
		    $cboxCol->close();
			
		$boxesRow->close();
	$headingBox->close();
}

echo '</center>';
?>

</div>