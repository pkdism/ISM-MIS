<?php

$ui = new UI();

$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Guests Details for the application ('.$app_num.')')
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
								<th><center>S.No.</center></th>
								<th><center>Guest Name</center></th>
								<th><center>Designation</center></th>
								<th><center>Address</center></th>
								<th><center>Gender</center></th>
								<th><center>Boarding</center></th>
								<th><center>Room Preference</center></th>
								<th><center>Allocation Status</center></th>
							</tr>
						</thead>
						<?php	
						$i=0;
						foreach($guests as $key => $guest) { 
							$i++;
							echo '
								<tr>
								<td>'.$i.'</td>
								<td><center>'.$guest['gname'].'</center></td>
								<td><center>'.$guest['desg'].'</center></td>
								<td><center>'.$guest['address'].'</center></td>
								<td><center>'.$guest['gender'].'</center></td>
								<td><center>'.$guest['boarding'].'</center></td>
								<td><center>'.$guest['room_pref'].'</center></td>
								<td><center>'.$guest['room_alloted'].'</center></td>
								</tr>';
						}
					$table->close();
		
$headingBox->close();

?>