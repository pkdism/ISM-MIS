<?php
	$ui = new UI();

//	$box = $ui->box()->uiType('primary')->open();
	$tabBox1 = $ui->tabBox()
		   ->icon($ui->icon("list"))	
		   ->title("Complaint List")
		   ->tab("registered_complaints", "Registerd Complaints", true)
		   ->tab("closed_complaints", "Closed Complaints")
		   ->tab("rejected_complaints", "Rejected Complaints")
		   ->tab("all_complaints", "All Complaints")
		   ->open();

		$tab1 = $ui->tabPane()->id("registered_complaints")->active()->open();

			if ($total_rows_under_processing == 0) {
				$ui->callout()
				   ->uiType("info")
				   ->title("No Complaints Registered.")
				   ->desc("")
				   ->show();
			}
			else {

				$table = $ui->table()->hover()->bordered()
							->sortable()->searchable()->paginated()
							->open();
?>
					<thead>		
						<tr>
							<th>Complaint ID</th>
							<th>Registered By</th>
							<th>Registered On</th>
							<th>Location</th>
				<!--			<th>Location Details</th>
							<th>Problem Details</th>
							<th>Remarks</th> -->
						</tr>
					</thead>
<?php
					$sno=1;
					while ($sno <= $total_rows_under_processing)
					{
?>
						<tr>
							<td><a href="<?php echo site_url("complaint/complaint_details/details/".$data_array_under_processing[$sno][1]."/UnderProcessing");?>"><?php echo $data_array_under_processing[$sno][1];?></a></td>
							<td><?php echo $data_array_under_processing[$sno][2];?></td>
							<td><?php echo $data_array_under_processing[$sno][3];?></td>
							<td><?php echo $data_array_under_processing[$sno][4];?></td>
		<!--					<td><?php //echo $data_array_under_processing[$sno][5];?></td>
							<td><?php //echo $data_array_under_processing[$sno][6];?></td>
							<td><?php //echo $data_array_under_processing[$sno][7];?></td> -->
						</tr>
<?php
						$sno++;
					}
				$table->close();
			}	

		$tab1->close();

		$tab2 = $ui->tabPane()->id("closed_complaints")->open();

			if ($total_rows_closed == 0) {
				$ui->callout()
				   ->uiType("info")
				   ->title("Closed Complaints not found.")
				   ->desc("")
				   ->show();
			}
			else {

				$table = $ui->table()->hover()->bordered()
							->sortable()->searchable()->paginated()
							->open();
?>
					<thead>		
						<tr>
							<th>Complaint ID</th>
							<th>Registered By</th>
							<th>Registered On</th>
							<th>Location</th>
				<!--			<th>Location Details</th>
							<th>Problem Details</th>
							<th>Remarks</th> -->
						</tr>
					</thead>
<?php
					$sno=1;
					while ($sno <= $total_rows_closed)
					{
?>
						<tr>
							<td><a href="<?php echo site_url("complaint/complaint_details/details/".$data_array_closed[$sno][1]);?>"><?php echo $data_array_closed[$sno][1];?></a></td>
							<td><?php echo $data_array_closed[$sno][2];?></td>
							<td><?php echo $data_array_closed[$sno][3];?></td>
							<td><?php echo $data_array_closed[$sno][4];?></td>
		<!--					<td><?php //echo $data_array_closed[$sno][5];?></td>
							<td><?php //echo $data_array_closed[$sno][6];?></td>
							<td><?php //echo $data_array_closed[$sno][7];?></td> -->
						</tr>
<?php
						$sno++;
					}
				$table->close();
			}
				
		$tab2->close();
		
		$tab3 = $ui->tabPane()->id("rejected_complaints")->open();

			if ($total_rows_rejected == 0) {
				$ui->callout()
				   ->uiType("info")
				   ->title("Rejected Complaints not found.")
				   ->desc("")
				   ->show();
			}

			else {

				$table = $ui->table()->hover()->bordered()
							->sortable()->searchable()->paginated()
							->open();
?>
					<thead>
						<tr>
							<th>Complaint ID</th>
							<th>Registered By</th>
							<th>Registered On</th>
							<th>Location</th>
				<!--			<th>Location Details</th>
							<th>Problem Details</th>
							<th>Remarks</th> -->
						</tr>
					</thead>	
<?php
					$sno=1;
					while ($sno <= $total_rows_rejected)
					{
?>
						<tr>
							<td><a href="<?php echo site_url("complaint/complaint_details/details/".$data_array_rejected[$sno][1]);?>"><?php echo $data_array_rejected[$sno][1];?></a></td>
							<td><?php echo $data_array_rejected[$sno][2];?></td>
							<td><?php echo $data_array_rejected[$sno][3];?></td>
							<td><?php echo $data_array_rejected[$sno][4];?></td>
		<!--					<td><?php //echo $data_array_rejected[$sno][5];?></td>
							<td><?php //echo $data_array_rejected[$sno][6];?></td>
							<td><?php //echo $data_array_rejected[$sno][7];?></td>-->
						</tr>
<?php
						$sno++;
					}
		
				$table->close();
			}	
		$tab3->close();
		
		$tab4 = $ui->tabPane()->id("all_complaints")->open();

			if ($total_rows_all == 0) {
				$ui->callout()
				   ->uiType("info")
				   ->title("NO Complaints found.")
				   ->desc("")
				   ->show();
			}

			else {

				$table = $ui->table()->hover()->bordered()
							->sortable()->searchable()->paginated()
							->open();
?>
					<thead>		
						<tr>
							<th>Complaint ID</th>
							<th>Status</th>
							<th>Registered By</th>
							<th>Registered On</th>
							<th>Location</th>
				<!--			<th>Location Details</th>
							<th>Problem Details</th>
							<th>Remarks</th> -->
						</tr>
					</thead>
<?php
					$sno=1;
					while ($sno <= $total_rows_all)
					{
?>
						<tr>
							<td><a href="<?php echo site_url("complaint/complaint_details/details/".$data_array_all[$sno][1]);?>"><?php echo $data_array_all[$sno][1];?></a></td>
							<td><?php echo $data_array_all[$sno][2];?></td>
							<td><?php echo $data_array_all[$sno][3];?></td>
							<td><?php echo $data_array_all[$sno][4];?></td>
							<td><?php echo $data_array_all[$sno][5];?></td>
		<!--					<td><?php //echo $data_array_all[$sno][6];?></td>
							<td><?php //echo $data_array_all[$sno][7];?></td>
							<td><?php //echo $data_array_all[$sno][8];?></td> -->
						</tr>
<?php
						$sno++;
					}
				$table->close();
			}	
		$tab4->close();
	
	$tabBox1->close();
?>