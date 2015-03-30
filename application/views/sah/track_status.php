<?php

$ui = new UI();

$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Application Details')
				 ->solid()
				 ->open();
		 
		$table = $ui->table()
					->id('currentTable')
					->responsive()
					->hover()
					->bordered()
					->striped()
					->sortable()
					->searchable()
					->paginated()
					->open();
	?>
						<thead>
							<tr>
								<th><center>Application Number</center></th>
								<th><center>Application Date</center></th>
								<th><center>Purpose of Application</center></th>
								<th><center>No. of Guests</center></th>
								<th width="80px"><center>Check-In</center></th>
								<th width="80px"><center>Check-Out</center></th>
								<th><center>HOD Status</center></th>
								<th><center>Allocation Status</center></th>
								<th><center>Link</center></th>
							</tr>
						</thead>
						<?php	
						foreach($applications as $key => $application) { 
							echo '
								<tr>
								<td><center>'.$application['app_num'].'</center></td>
								<td><center>'.$application['app_date'].'</center></td>
								<td><center>'.$application['purpose'].'</center></td>
								<td><center>'.$application['num_of_guest'].'</center></td>
								<td><center>'.$application['check_in'].'</center></td>
								<td><center>'.$application['check_out'].'</center></td>
								<td><center>'.$application['approved_by'].'</center></td>
								<td><center>';
								     if($application['app_status'] == 'Booked')
										echo '<a href="'.base_url().'index.php/sah/booking/get_booking_details/'.$application['app_num'].'">Booked</a>';
									 else
									    echo $application['app_status'];
								echo '</center></td>
								<td><center>';
										echo '<a href="'.base_url().'index.php/sah/booking/get_guests/'.$application['app_num'].'">Guests</a>
								     </center></td>
								</tr>';
						}
					$table->close();
		
$headingBox->close();

?>