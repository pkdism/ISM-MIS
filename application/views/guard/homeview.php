<div id="print">
<?php
echo '<center>';
if (isset($details_of_guards_at_a_post))
{
	$ui = new UI();
	$headingBox = $ui->box()
				 ->id('postDutyChartBox')
				 ->uiType('info')
				 ->title('Complete Duty Chart')
				 ->solid()
				 ->open();
	
	$table = $ui->table()
				->id('postDutyChartTable')
				->responsive()
				->hover()
				->bordered()
				->striped()
				->sortable()
				->paginated()
				->searchable()
				->open();
?>
		<thead>
            <tr>
                <th><center>Duty Date</center></th>
				<th><center>Guard Name</center></th>
				<th class="print-no-display">Photo</th>
				<th><center>Shift</center></th>
            </tr>
		</thead>

        <tfoot>
            <tr>
                <th><center>Duty Date</center></th>
				<th><center>Guard Name</center></th>
				<th class="print-no-display">Photo</th>
				<th><center>Shift</center></th>
            </tr>
        </tfoot>	
<?php	
	$table->close();
$headingBox->close();				 

}

else if(isset($details_of_guards_at_a_post_A))
{
	$postname='';
	foreach($details_of_guards_at_a_post_A as $row)
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
			
			$aBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
		   
				$aBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift A')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$aCol = $ui->col()
								   ->open();
						  
		    				$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
								      	<tr>
												<th><center>Guard</center></th>
												<th><center>Photo</center></th>
												<th><center>Date</center></th>
										</tr>';
									foreach ($details_of_guards_at_a_post_A as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();
											
						$aCol->close();
											
					 $guardRow->close();
				$aBox->close();
			$aBoxCol->close();
			
			$bBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
			   
			   $bBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift B')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$bCol = $ui->col()
								   ->open();
						  
		    				$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Guard</center></th>
												<th><center>Photo</center></th>
												<th><center>Date</center></th>
											</tr>';
									foreach ($details_of_guards_at_a_post_B as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();
											
						$bCol->close();
											
					 $guardRow->close();
				$bBox->close();
			$bBoxCol->close();
			
            $cBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();			
				
				$cBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift C')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$cCol = $ui->col()
								   ->open();
						  
		    				$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Guard</center></th>
												<th><center>Photo</center></th>
												<th><center>Date</center></th>
											</tr>';
									foreach ($details_of_guards_at_a_post_C as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();
											
						$cCol->close();
											
					 $guardRow->close();
								
				$cBox->close();
			$cBoxCol->close();
		$boxesRow->close();			
			
	$headingBox->close();
}

else if(isset($details_of_guards_at_a_date_A))
{
	$ui = new UI();
	$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Details of Guards on '.date('d M Y',strtotime($selectdate)+19800))
				 ->solid()
				 ->open();
		$boxesRow = $ui->row()
					   ->open();
			
			$aBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
		   
				$aBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift A')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$aCol = $ui->col()
								   ->open();
						  
		    				$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Guard</center></th>
												<th><center>Photo</center></th>
												<th><center>Post</center></th>
											</tr>';
									foreach ($details_of_guards_at_a_date_A as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$row->postname.'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();
											
						$aCol->close();
											
					 $guardRow->close();
				$aBox->close();
			$aBoxCol->close();
			
			$bBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
			   
			   $bBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift B')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$bCol = $ui->col()
								   ->open();
						  
		    				$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Guard</center></th>
												<th><center>Photo</center></th>
												<th><center>Post</center></th>
											</tr>';
									foreach ($details_of_guards_at_a_date_B as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$row->postname.'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();
											
						$bCol->close();
											
					 $guardRow->close();
				$bBox->close();
			$bBoxCol->close();
			
            $cBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();			
				
				$cBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift C')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$cCol = $ui->col()
								   ->open();
						  
		    				$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Guard</center></th>
												<th><center>Photo</center></th>
												<th><center>Post</center></th>
											</tr>';
									foreach ($details_of_guards_at_a_date_C as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$row->postname.'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();
											
						$cCol->close();
											
					 $guardRow->close();
								
				$cBox->close();
			$cBoxCol->close();
		$boxesRow->close();			
			
	$headingBox->close();
	
	
}	
else if(isset($details_of_guard_in_a_range_A))
{
	$count = count($details_of_guard_in_a_range_A) + count($details_of_guard_in_a_range_B) + count($details_of_guard_in_a_range_C);
	$ui = new UI();
	$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Duty of '.$details_of_a_guard['firstname'].' '.$details_of_a_guard['lastname'].' from '.date('d M Y',strtotime($fromdateg)+19800).' to '.date('d M Y',strtotime($todateg)+19800))
				 ->solid()
				 ->open();
				 
		$boxesRow = $ui->row()
					   ->open();
			echo '<br><center><img src="'.base_url().'assets/images/guard/'.$details_of_a_guard['photo'].'" width="80px" height="80px"/></center></br>';
			echo '<b>Total Number of working shifts '.$count.'</b></br>';
			$aBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
		   
				$aBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift A')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
								   ->id('guardRow')
								   ->open();
							
						$aCol = $ui->col()
								   ->open();
						  
		    				    $table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Post</center></th>
												<th><center>Date</center></th>
											</tr>';
									foreach ($details_of_guard_in_a_range_A as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->postname.'</center></td>
																	<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();		
						$aCol->close();
											
					 $guardRow->close();
				$aBox->close();
			$aBoxCol->close();
						
			$bBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
			   
			   $bBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift B')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$bCol = $ui->col()
								   ->open();
						  
		    				  $table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Post</center></th>
												<th><center>Date</center></th>
											</tr>';
									foreach ($details_of_guard_in_a_range_B as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->postname.'</center></td>
																	<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();	
						$bCol->close();
											
					 $guardRow->close();
				$bBox->close();
			$bBoxCol->close();
			


			$cBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();			
				
				$cBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift C')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$cCol = $ui->col()
								   ->open();
						  
		    				  $table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Post</center></th>
												<th><center>Date</center></th>
											</tr>';
									foreach ($details_of_guard_in_a_range_C as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->postname.'</center></td>
																	<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();
						$cCol->close();
											
					 $guardRow->close();
								
				$cBox->close();
			$cBoxCol->close();
            
		$boxesRow->close();			
			
	$headingBox->close();

}

else if(isset($details_of_guards_in_a_range_A))
{
	$ui = new UI();
	$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Details of Guards from '.date('d M Y',strtotime($fromdate)+19800).' to '.date('d M Y',strtotime($todate)+19800))
				 ->solid()
				 ->open();
				 
		$boxesRow = $ui->row()
					   ->open();
			
			$aBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
		   
				$aBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift A')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
								   ->id('guardRow')
								   ->open();
							
						$aCol = $ui->col()
								   ->open();
						  
		    				        $date = '';
									foreach ($details_of_guards_in_a_range_A as $row)
									{ 
										if($date !='' && $date != $row->date)
										{
											echo '</tbody>';
											$table->close();
											echo '<br>';
						
										}	
										if($date != $row->date)
										{
											$date = $row->date;
											echo '<b>Date: '.date('d M Y',strtotime($date) + 19800).'</b><br>';
											$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

											echo '<tbody>
														<tr>
															<th><center>Guard</center></th>
															<th><center>Photo</center></th>
															<th><center>Post</center></th>
														</tr>';
										}										
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$row->postname.'</center></td>	
																</tr>';
									}
									if(count($details_of_guards_in_a_range_A))
									{
										echo '</tbody>';
										$table->close();			
									}		
						$aCol->close();
											
					 $guardRow->close();
				$aBox->close();
			$aBoxCol->close();
						
			$bBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
			   
			   $bBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift B')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$bCol = $ui->col()
								   ->open();
						  
		    				  $date = '';
									foreach ($details_of_guards_in_a_range_B as $row)
									{ 
										if($date !='' && $date != $row->date)
										{
											echo '</tbody>';
											$table->close();
											echo '<br>';
						
										}	
										if($date != $row->date)
										{
											$date = $row->date;
											echo '<b>Date: '.date('d M Y',strtotime($date) + 19800).'</b><br>';
											$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

											echo '<tbody>
														<tr>
															<th><center>Guard</center></th>
															<th><center>Photo</center></th>
															<th><center>Post</center></th>
														</tr>';
										}										
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$row->postname.'</center></td>	
																</tr>';
									}
									if(count($details_of_guards_in_a_range_B))
									{
										echo '</tbody>';
										$table->close();			
									}		
						$bCol->close();
											
					 $guardRow->close();
				$bBox->close();
			$bBoxCol->close();
			


			$cBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();			
				
				$cBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift C')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$cCol = $ui->col()
								   ->open();
						  
		    				  $date = '';
									foreach ($details_of_guards_in_a_range_C as $row)
									{ 
										if($date !='' && $date != $row->date)
										{
											echo '</tbody>';
											$table->close();
											echo '<br>';
										}	
										if($date != $row->date)
										{
											$date = $row->date;
											echo '<b>Date: '.date('d M Y',strtotime($date) + 19800).'</b><br>';
											$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

											echo '<tbody>
														<tr>
															<th><center>Guard</center></th>
															<th><center>Photo</center></th>
															<th><center>Post</center></th>
														</tr>';
										}										
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$row->postname.'</center></td>	
																</tr>';
									}
									if(count($details_of_guards_in_a_range_C))
									{
										echo '</tbody>';
										$table->close();			
									}	
						$cCol->close();
											
					 $guardRow->close();
								
				$cBox->close();
			$cBoxCol->close();
            
		$boxesRow->close();			
			
	$headingBox->close();
		
}
else if(isset($details_of_guards_at_a_post_in_a_range_A))
{
	$postname='';
	foreach($details_of_guards_at_a_post_in_a_range_A as $row)
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
			
			$aBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
		   
				$aBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift A')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
								   ->id('guardRow')
								   ->open();
							
						$aCol = $ui->col()
								   ->open();
						  
		    				        $date = '';
									foreach ($details_of_guards_at_a_post_in_a_range_A as $row)
									{ 
										if($date !='' && $date != $row->date)
										{
											echo '</tbody>';
											$table->close();
											echo '<br>';
						
										}	
										if($date != $row->date)
										{
											$date = $row->date;
											echo '<b>Date: '.date('d M Y',strtotime($date) + 19800).'</b><br>';
											$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

											echo '<tbody>
														<tr>
															<th><center>Guard</center></th>
															<th><center>Photo</center></th>
														</tr>';
										}										
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																</tr>';
									}
									if(count($details_of_guards_at_a_post_in_a_range_A))
									{
										echo '</tbody>';
										$table->close();			
									}
						$aCol->close();
											
					 $guardRow->close();
				$aBox->close();
			$aBoxCol->close();
						
			$bBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
			   
			   $bBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift B')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$bCol = $ui->col()
								   ->open();
						  
		    				  $date = '';
									foreach ($details_of_guards_at_a_post_in_a_range_B as $row)
									{ 
										if($date !='' && $date != $row->date)
										{
											echo '</tbody>';
											$table->close();
											echo '<br>';
						
										}	
										if($date != $row->date)
										{
											$date = $row->date;
											echo '<b>Date: '.date('d M Y',strtotime($date) + 19800).'</b><br>';
											$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

											echo '<tbody>
														<tr>
															<th><center>Guard</center></th>
															<th><center>Photo</center></th>
														</tr>';
										}										
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																</tr>';
									}
									if(count($details_of_guards_at_a_post_in_a_range_B))
									{
										echo '</tbody>';
										$table->close();			
									}		
						$bCol->close();
											
					 $guardRow->close();
				$bBox->close();
			$bBoxCol->close();
			


			$cBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();			
				
				$cBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift C')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$cCol = $ui->col()
								   ->open();
						  
		    				  $date = '';
									foreach ($details_of_guards_at_a_post_in_a_range_C as $row)
									{ 
										if($date !='' && $date != $row->date)
										{
											echo '</tbody>';
											$table->close();
											echo '<br>';
										}	
										if($date != $row->date)
										{
											$date = $row->date;
											echo '<b>Date: '.date('d M Y',strtotime($date) + 19800).'</b><br>';
											$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

											echo '<tbody>
														<tr>
															<th><center>Guard</center></th>
															<th><center>Photo</center></th>
														</tr>';
										}										
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																</tr>';
									}
									if(count($details_of_guards_at_a_post_in_a_range_C))
									{
										echo '</tbody>';
										$table->close();			
									}
						$cCol->close();
											
					 $guardRow->close();
								
				$cBox->close();
			$cBoxCol->close();
            
		$boxesRow->close();			
			
	$headingBox->close();
}

echo '</center>';
?>
</div>